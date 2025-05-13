/**
 * Camera Admin JavaScript
 */
(function($) {
    'use strict';
    
    // Initialize media uploader
    let mediaUploader = null;
    
    $(document).ready(function() {
        // Handle select image button click
        $('.camera-items-container').on('click', '.select-camera-image', function(e) {
            e.preventDefault();
            
            const button = $(this);
            const postId = button.data('id');
            const spinner = button.siblings('.spinner');
            const messageContainer = button.siblings('.update-message');
            
            // Clear any previous messages
            messageContainer.empty().removeClass('notice-success notice-error');
            
            // Create a new media uploader instance each time
            mediaUploader = wp.media({
                title: camera_admin.select_image || 'Select Image',
                button: {
                    text: camera_admin.use_image || 'Use This Image'
                },
                multiple: false
            });
            
            // When an image is selected, handle the selection
            mediaUploader.on('select', function() {
                const attachment = mediaUploader.state().get('selection').first().toJSON();
                
                if (!attachment.id) {
                    return;
                }
                
                // Show spinner
                spinner.addClass('is-active');
                
                // Send AJAX request to update the image
                $.ajax({
                    url: camera_admin.ajax_url,
                    type: 'POST',
                    data: {
                        action: 'update_camera_image',
                        nonce: camera_admin.nonce,
                        post_id: postId,
                        image_id: attachment.id
                    },
                    success: function(response) {
                        spinner.removeClass('is-active');
                        
                        if (response.success) {
                            const row = button.closest('tr');
                            const imageCell = row.find('.camera-image-cell');
                            
                            // Update the image preview
                            if (imageCell.find('.camera-image-preview').length) {
                                imageCell.find('img').attr('src', response.data.image_url);
                            } else {
                                imageCell.html('<div class="camera-image-preview"><img src="' + response.data.image_url + '" alt=""></div>');
                            }
                            
                            // Update button text if necessary
                            button.text('Change Image');
                            
                            // Add remove button if not already present
                            if (!button.siblings('.remove-camera-image').length) {
                                button.after('<button class="button remove-camera-image" data-id="' + postId + '">Remove</button>');
                            }
                            
                            // Show success message
                            messageContainer.text(response.data.message).addClass('notice-success').show();
                            setTimeout(function() {
                                messageContainer.fadeOut();
                            }, 3000);
                        } else {
                            // Show error message
                            messageContainer.text(response.data).addClass('notice-error').show();
                        }
                    },
                    error: function() {
                        spinner.removeClass('is-active');
                        messageContainer.text('Error occurred. Please try again.').addClass('notice-error').show();
                    }
                });
            });
            
            // Open the media uploader
            mediaUploader.open();
        });
        
        // Handle remove image button click
        $('.camera-items-container').on('click', '.remove-camera-image', function(e) {
            e.preventDefault();
            
            const button = $(this);
            const postId = button.data('id');
            const spinner = button.siblings('.spinner');
            const messageContainer = button.siblings('.update-message');
            
            // Clear any previous messages
            messageContainer.empty().removeClass('notice-success notice-error');
            
            if (!confirm('Are you sure you want to remove this image?')) {
                return;
            }
            
            // Show spinner
            spinner.addClass('is-active');
            
            // Send AJAX request to remove the image
            $.ajax({
                url: camera_admin.ajax_url,
                type: 'POST',
                data: {
                    action: 'remove_camera_image',
                    nonce: camera_admin.nonce,
                    post_id: postId
                },
                success: function(response) {
                    spinner.removeClass('is-active');
                    
                    if (response.success) {
                        const row = button.closest('tr');
                        const imageCell = row.find('.camera-image-cell');
                        const selectButton = button.siblings('.select-camera-image');
                        
                        // Update the image cell
                        imageCell.html('<span class="no-image">No image</span>');
                        
                        // Update select button text
                        selectButton.text('Add Image');
                        
                        // Remove the remove button
                        button.remove();
                        
                        // Show success message
                        messageContainer.text(response.data.message).addClass('notice-success').show();
                        setTimeout(function() {
                            messageContainer.fadeOut();
                        }, 3000);
                    } else {
                        // Show error message
                        messageContainer.text(response.data).addClass('notice-error').show();
                    }
                },
                error: function() {
                    spinner.removeClass('is-active');
                    messageContainer.text('Error occurred. Please try again.').addClass('notice-error').show();
                }
            });
        });
        
        // Handle live search functionality
        let searchTimer;
        const searchInput = $('.camera-search-form input[name="camera_search"]');
        
        searchInput.on('keyup', function() {
            clearTimeout(searchTimer);
            const query = $(this).val();
            
            searchTimer = setTimeout(function() {
                performLiveSearch(query, 1);
            }, 500);
        });
        
        // Handle pagination clicks for AJAX pagination
        $('.camera-pagination').on('click', 'a.page-numbers', function(e) {
            e.preventDefault();
            
            const href = $(this).attr('href');
            const pageMatch = href.match(/paged=(\d+)/);
            const page = pageMatch ? parseInt(pageMatch[1]) : 1;
            const query = searchInput.val();
            
            performLiveSearch(query, page);
        });
        
        // Function to perform live search with AJAX
        function performLiveSearch(query, page) {
            const tableBody = $('.camera-items-table tbody');
            const paginationContainer = $('.camera-pagination');
            
            // Add loading indicator
            tableBody.html('<tr><td colspan="4" class="loading">Loading...</td></tr>');
            
            // Send AJAX request
            $.ajax({
                url: camera_admin.ajax_url,
                type: 'POST',
                data: {
                    action: 'search_camera_posts',
                    nonce: camera_admin.nonce,
                    search: query,
                    page: page
                },
                success: function(response) {
                    if (response.success) {
                        // Update table body
                        tableBody.html(response.data.html);
                        
                        // Update pagination
                        if (response.data.total_pages > 1) {
                            // We need to update the URL for proper pagination
                            const baseUrl = window.location.pathname + window.location.search;
                            const urlWithoutPaged = baseUrl.replace(/&paged=\d+/, '');
                            
                            const paginationLinks = paginate_links({
                                base: urlWithoutPaged + '&paged=%#%',
                                format: '',
                                current: page,
                                total: response.data.total_pages,
                                prev_text: '« Previous',
                                next_text: 'Next »'
                            });
                            
                            paginationContainer.html(paginationLinks).show();
                        } else {
                            paginationContainer.hide();
                        }
                        
                        // Update URL without refreshing page
                        const newUrl = updateUrlParameter(window.location.href, 'camera_search', query);
                        const finalUrl = updateUrlParameter(newUrl, 'paged', page);
                        window.history.pushState({}, '', finalUrl);
                    }
                },
                error: function() {
                    tableBody.html('<tr><td colspan="4">Error loading results. Please try again.</td></tr>');
                }
            });
        }
        
        // Helper function to paginate links (simplified version)
        function paginate_links(args) {
            const { base, current, total, prev_text, next_text } = args;
            let output = '<div class="tablenav-pages">';
            
            // Previous button
            if (current > 1) {
                output += '<a class="prev-page page-numbers" href="' + base.replace('%#%', current - 1) + '">' + prev_text + '</a>';
            }
            
            // Page numbers
            for (let i = 1; i <= total; i++) {
                if (i === current) {
                    output += '<span class="page-numbers current">' + i + '</span>';
                } else {
                    output += '<a class="page-numbers" href="' + base.replace('%#%', i) + '">' + i + '</a>';
                }
            }
            
            // Next button
            if (current < total) {
                output += '<a class="next-page page-numbers" href="' + base.replace('%#%', current + 1) + '">' + next_text + '</a>';
            }
            
            output += '</div>';
            return output;
        }
        
        // Helper function to update URL parameters
        function updateUrlParameter(url, key, value) {
            const re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
            const separator = url.indexOf('?') !== -1 ? "&" : "?";
            
            if (url.match(re)) {
                return value ? url.replace(re, '$1' + key + "=" + value + '$2') : url.replace(re, '$1$2');
            } else {
                return value ? url + separator + key + "=" + value : url;
            }
        }
    });
    
})(jQuery);