// static/js/dynamic_dropdowns.js

function setupDynamicDropdowns(urlPattern) {
    document.querySelectorAll('.dynamic-dropdown').forEach(function(dropdown) {
        dropdown.addEventListener('change', function() {
            const targetId = this.getAttribute('data-target');
            const targetDropdown = document.getElementById(targetId);
            if (targetDropdown) {
                fetch(urlPattern.replace('123', this.value))
                    .then(response => response.json())
                    .then(data => {
                        targetDropdown.innerHTML = '';
                        data.options.forEach(option => {
                            targetDropdown.add(new Option(option.text, option.value));
                        });
                    });
            }
        });
    });
}
