window.addEventListener('DOMContentLoaded', () => {

    emailjs.init({
        publicKey: "wwoGi5XInqitBeiFW",
    });

    const contactForm = document.getElementById('contactForm');
    const formMessage = document.getElementById('formMessage');

    if (!contactForm) {
        console.error('Contact form not found');
        return;
    }

    contactForm.addEventListener('submit', async function (e) {
        e.preventDefault();

        const submitBtn = contactForm.querySelector('button[type="submit"]');
        const originalText = submitBtn.textContent;

        submitBtn.textContent = 'Sending...';
        submitBtn.disabled = true;

        try {

            const templateParams = {
                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
                phone: document.getElementById('phone').value,
                topic: document.getElementById('topic').value,
                message: document.getElementById('message').value,
            };

            await emailjs.send(
                'service_pnz3ev4',
                'template_oo2ox78',
                templateParams
            );

            formMessage.textContent =
                'Thank you! Your message has been sent successfully.';

            formMessage.className = 'form-message success';
            formMessage.style.display = 'block';

            contactForm.reset();

        } catch (error) {

            console.error('EmailJS error:', error);

            formMessage.textContent =
                'Sorry, there was an error sending your message.';

            formMessage.className = 'form-message error';
            formMessage.style.display = 'block';

        } finally {

            submitBtn.textContent = originalText;
            submitBtn.disabled = false;

            setTimeout(() => {
                formMessage.style.display = 'none';
            }, 5000);
        }
    });
});
