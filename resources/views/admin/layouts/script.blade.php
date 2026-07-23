<script src='{{ asset('assets/libs/choices.js/public/assets/scripts/choices.min.js') }}'></script>
<script src="{{ asset('assets/libs/%40popperjs/core/umd/popper.min.js') }}"></script>
<script src="{{ asset('assets/libs/tippy.js/tippy-bundle.umd.min.js') }}"></script>
<script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/libs/prismjs/prism.js') }}"></script>
<script src="{{ asset('assets/libs/lucide/umd/lucide.js') }}"></script>
<script src="{{ asset('assets/js/starcode.bundle.js') }}"></script>

<script src="{{ asset('assets/js/pages/form-editor-classic.init.js') }}"></script>

<script src="{{ asset('assets/js/datatables/jquery-3.7.0.js') }}"></script>
<script src="{{ asset('assets/js/datatables/data-tables.min.js') }}"></script>
<script src="{{ asset('assets/js/datatables/data-tables.tailwindcss.min.js') }}"></script>
<!--buttons dataTables-->
<script src="{{ asset('assets/js/datatables/datatables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/js/datatables/jszip.min.js') }}"></script>
<script src="{{ asset('assets/js/datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/js/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/js/datatables/buttons.print.min.js') }}"></script>

<script src="{{ asset('assets/js/datatables/datatables.init.js') }}"></script>

<script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>


<!-- cleave.js -->
<script src="{{ asset('assets/libs/cleave.js/cleave.min.js') }}"></script>

<script src="{{ asset('assets/js/pages/form-mask.init.js') }}"></script>

<!-- App js -->
<script src="{{ asset('assets/js/app.js') }}"></script>
<script>
    // Force initialize dropdown setelah semua script loaded
    window.addEventListener('load', function() {
        console.log('Window loaded, initializing dropdowns...');

        // Wait for all scripts to complete
        setTimeout(function() {
            const dropdownButtons = document.querySelectorAll('#scrollbar .dropdown-button');
            console.log('Dropdown buttons found:', dropdownButtons.length);

            dropdownButtons.forEach(function(button, index) {
                const content = button.nextElementSibling;

                // Remove old listeners by cloning
                const newButton = button.cloneNode(true);
                button.parentNode.replaceChild(newButton, button);

                // Add fresh listener
                newButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    console.log('Dropdown button clicked:', index);

                    if (content) {
                        const isHidden = content.classList.contains('hidden');

                        // Close other dropdowns
                        document.querySelectorAll('#scrollbar .dropdown-content')
                            .forEach(function(otherContent) {
                                if (otherContent !== content) {
                                    otherContent.classList.add('hidden');
                                    otherContent.previousElementSibling?.classList
                                        .remove('show');
                                }
                            });

                        // Toggle current dropdown
                        if (isHidden) {
                            content.classList.remove('hidden');
                            newButton.classList.add('show');
                        } else {
                            content.classList.add('hidden');
                            newButton.classList.remove('show');
                        }

                        console.log('Dropdown toggled:', !isHidden);
                    }
                });

                // Ensure visibility
                newButton.style.pointerEvents = 'auto';
                newButton.style.cursor = 'pointer';
            });

            console.log('Dropdown initialization complete!');
        }, 1000); // Wait 1 second for all scripts
    });
</script>

<!-- Cropper.js JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fileInputs = document.querySelectorAll('input[type="file"][data-cropper="true"]');
        if (fileInputs.length === 0) return;

        const modal = document.getElementById('cropperModal');
        const cropperImage = document.getElementById('cropperImage');
        const saveBtn = document.getElementById('saveCropBtn');
        const cancelBtn = document.getElementById('cancelCropBtn');
        const closeBtn = document.getElementById('closeCropperModal');
        
        let cropper = null;
        let activeInput = null;
        let originalFileName = '';

        fileInputs.forEach(input => {
            input.addEventListener('change', function(e) {
                const files = e.target.files;
                if (files && files.length > 0) {
                    activeInput = input;
                    const file = files[0];
                    originalFileName = file.name;
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        cropperImage.src = e.target.result;
                        modal.classList.remove('hidden');
                        modal.classList.add('flex');
                        
                        // Get aspect ratio
                        const ratioStr = input.getAttribute('data-aspect-ratio');
                        let ratio = NaN;
                        if (ratioStr) {
                            if (ratioStr.includes('/')) {
                                const parts = ratioStr.split('/');
                                ratio = parseFloat(parts[0]) / parseFloat(parts[1]);
                            } else {
                                ratio = parseFloat(ratioStr);
                            }
                        }
                        
                        if (cropper) {
                            cropper.destroy();
                        }
                        
                        cropper = new Cropper(cropperImage, {
                            aspectRatio: ratio,
                            viewMode: 1,
                            background: false,
                            autoCropArea: 1,
                        });
                    };
                    reader.readAsDataURL(file);
                }
            });
        });

        function closeModal() {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            if (cropper) {
                cropper.destroy();
                cropper = null;
            }
            if (activeInput && !activeInput.dataset.cropped) {
                activeInput.value = '';
            }
            if (activeInput) {
                delete activeInput.dataset.cropped;
            }
        }

        if (cancelBtn) cancelBtn.addEventListener('click', closeModal);
        if (closeBtn) closeBtn.addEventListener('click', closeModal);

        if (saveBtn) {
            saveBtn.addEventListener('click', function() {
                if (!cropper || !activeInput) return;

                const canvas = cropper.getCroppedCanvas();
                canvas.toBlob(function(blob) {
                    const file = new File([blob], originalFileName, { type: 'image/jpeg' });
                    const container = new DataTransfer();
                    container.items.add(file);
                    
                    activeInput.dataset.cropped = 'true';
                    activeInput.files = container.files;
                    
                    // Trigger preview if data-preview-id is provided
                    const previewId = activeInput.getAttribute('data-preview-id');
                    if (previewId) {
                        const previewImg = document.getElementById(previewId);
                        if (previewImg) {
                            previewImg.src = URL.createObjectURL(blob);
                        }
                    }
                    
                    closeModal();
                }, 'image/jpeg', 0.9);
            });
        }
    });
</script>

@stack('scripts')
