<script src='{{ asset('assets/libs/choices.js/public/assets/scripts/choices.min.js') }}'></script>
<script src="{{ asset('assets/libs/%40popperjs/core/umd/popper.min.js') }}"></script>
<script src="{{ asset('assets/libs/tippy.js/tippy-bundle.umd.min.js') }}"></script>
<script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/libs/prismjs/prism.js') }}"></script>
<script src="{{ asset('assets/libs/lucide/umd/lucide.js') }}"></script>
<script src="{{ asset('assets/js/starcode.bundle.js') }}"></script>

<script src="{{ asset('assets/js/pages/form-editor-classic.init.js') }}"></script>
<script src="{{ asset('assets/js/pages/landing-onepage.init.js') }}"></script>

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

<!--dashboard ecommerce init js-->
<script src="{{ asset('assets/js/pages/dashboards-ecommerce.init.js') }}"></script>

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

@stack('scripts')
