// Wait for page to fully load
window.addEventListener('DOMContentLoaded', () => {

    // Initialize EmailJS
    emailjs.init({
    publicKey: "wwoGi5XInqitBeiFW",
    });

    const contactForm = document.getElementById('contactForm');
    const formMessage = document.getElementById('formMessage');

    // Safety check
    if (!contactForm) {
        console.error('Contact form not found');
        return;
    }

    contactForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const submitBtn = contactForm.querySelector('button[type="submit"]');
        const originalText = submitBtn.textContent;

        // Loading state
        submitBtn.textContent = 'Sending...';
        submitBtn.disabled = true;

        // Send form using EmailJS
        emailjs.sendForm(
            'service_pnz3ev4',
            'template_oo2ox78',
            this
        )
        .then(() => {
            formMessage.textContent = 'Thank you! Your message has been sent successfully.';
            formMessage.className = 'form-message success';
            formMessage.style.display = 'block';

            contactForm.reset();
        })
        .catch((error) => {
            console.error('EmailJS error:', error);

            formMessage.textContent = 'Sorry, there was an error sending your message.';
            formMessage.className = 'form-message error';
            formMessage.style.display = 'block';
        })
        .finally(() => {
            submitBtn.textContent = originalText;
            submitBtn.disabled = false;

            setTimeout(() => {
                formMessage.style.display = 'none';
            }, 5000);
        });
    });
});
