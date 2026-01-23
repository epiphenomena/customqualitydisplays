// Portfolio Modal Functionality
document.addEventListener('DOMContentLoaded', function() {
    const portfolioItems = document.querySelectorAll('.portfolio-item');
    const modal = document.getElementById('imageModal');
    const modalImg = document.getElementById('modalImage');
    const modalTitle = document.getElementById('modalTitle');
    const modalDesc = document.getElementById('modalDesc');
    const modalFullDesc = document.getElementById('modalFullDesc');
    const closeModalButton = document.querySelector('.close-modal');

    // Open modal when portfolio item is clicked
    portfolioItems.forEach((item, index) => {
        item.addEventListener('click', () => {
            const imgSrc = item.querySelector('img').src;
            const title = item.querySelector('h3').textContent;
            const desc = item.querySelector('p').textContent;
            const fullDesc = item.getAttribute('data-full-desc') || "Additional details about this project.";

            modalImg.src = imgSrc;
            modalTitle.textContent = title;
            modalDesc.textContent = desc;
            modalFullDesc.textContent = fullDesc;

            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        });
    });

    // Close modal when X is clicked
    closeModalButton.addEventListener('click', closeModal);

    // Close modal when clicking outside the content
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            closeModal();
        }
    });

    // Function to close the modal with animation
    function closeModal() {
        modal.classList.add('closing');
        setTimeout(() => {
            modal.style.display = 'none';
            modal.classList.remove('closing');
            document.body.style.overflow = 'auto';
        }, 300);
    }

    // Form submission
    const form = document.getElementById('estimateForm');
    const submitBtn = form.querySelector('.submit-btn');

    // Function to check if all required fields are filled
    function checkFormValidity() {
        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();

        // Simple email validation (check for @ and .)
        const emailValid = email.includes('@') && email.includes('.');

        if (name && email && emailValid) {
            submitBtn.disabled = false;
        } else {
            submitBtn.disabled = true;
        }
    }

    // Add real-time email validation
    const emailInput = document.getElementById('email');
    emailInput.addEventListener('blur', function() {
        const email = this.value.trim();
        // Simple email validation (check for @ and .)
        if (email && (!email.includes('@') || !email.includes('.'))) {
            this.style.borderColor = 'red';
        } else {
            this.style.borderColor = '';
        }
    });

    emailInput.addEventListener('input', function() {
        // Reset border color when user starts typing
        this.style.borderColor = '';
    });

    // Add event listeners to all form inputs
    form.querySelectorAll('input, textarea').forEach(element => {
        element.addEventListener('input', checkFormValidity);
    });

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const phone = document.getElementById('phone').value.trim();
        const project = document.getElementById('project').value.trim();

        // Create form data
        const formData = new FormData();
        formData.append('name', name);
        formData.append('email', email);
        formData.append('phone', phone);
        formData.append('project', project);
        formData.append('website', document.getElementById('website').value);

        try {
            const response = await fetch('contact.php', {
                method: 'POST',
                body: formData
            });

            if (response.ok) {
                // Replace form with thank you message
                form.innerHTML = `
                    <div class="thank-you-message">
                        <h3>Thank You!</h3>
                        <p>We've received your request and will contact you within 24 hours to discuss your project.</p>
                        <p>If you have any urgent questions, please call us at (555) 123-4567.</p>
                    </div>
                `;
            } else {
                alert('Oops! Something went wrong and we couldn\'t send your request. Please try again.');
            }
        } catch (error) {
            alert('Oops! Something went wrong and we couldn\'t send your request. Please try again.');
        }
    });

    // Scroll animations
    function checkScroll() {
        const sections = document.querySelectorAll('.section');
        const portfolioItems = document.querySelectorAll('.portfolio-item');

        sections.forEach(section => {
            const sectionTop = section.getBoundingClientRect().top;
            const triggerPoint = window.innerHeight * 0.85;

            if (sectionTop < triggerPoint) {
                section.classList.add('visible');
            }
        });

        // Animate portfolio items with a delay between each
        portfolioItems.forEach((item, index) => {
            const itemTop = item.getBoundingClientRect().top;
            const triggerPoint = window.innerHeight * 0.85;

            if (itemTop < triggerPoint) {
                setTimeout(() => {
                    item.classList.add('visible');
                }, index * 100);
            }
        });
    }

    // Initial check and add scroll listener
    checkScroll();
    window.addEventListener('scroll', checkScroll);

    // Set the decoded email address in the footer
    // Email is "contact@qcdisplays.com" encoded with btoa
    var encodedEmail = "Y29udGFjdEBxY2Rpc3BsYXlzLmNvbQ==";
    var decodedEmail = atob(encodedEmail);
    var emailElement = document.getElementById('contactEmail');
    emailElement.href = 'mailto:' + decodedEmail;
    emailElement.textContent = decodedEmail;

    // Add loaded class to hero section for background image transition
    var heroSection = document.querySelector('.hero');
    if (heroSection) {
        // Small delay to ensure the transition is visible
        setTimeout(function() {
            heroSection.classList.add('loaded');
        }, 100);
    }

    // Add btn class to the last link in the hero section
    const heroContent = document.querySelector('.hero-content');
    if (heroContent) {
        const links = heroContent.querySelectorAll('a');
        if (links.length > 0) {
            const lastLink = links[links.length - 1];
            lastLink.classList.add('btn');
        }
    }
});