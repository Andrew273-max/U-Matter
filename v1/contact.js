// EmailJS integration for contact form
document.addEventListener('DOMContentLoaded', function() {
    // Initialize EmailJS with your public key
    emailjs.init("wwoGi5XInqitBeiFW");     
    const contactForm = document.getElementById('contactForm');
    const formMessage = document.getElementById('formMessage');
    
    contactForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Show loading state
        const submitBtn = contactForm.querySelector('button[type="submit"]');
        const originalText = submitBtn.textContent;
        submitBtn.textContent = 'Sending...';
        submitBtn.disabled = true;
        
        // Send email using EmailJS
        emailjs.sendForm('service_pnz3ev4', 'template_oo2ox78', this)
            .then(function() {
                formMessage.textContent = 'Thank you! Your message has been sent successfully.';
                formMessage.classList.add('success');
                formMessage.style.display = 'block';
                contactForm.reset();
            }, function(error) {
                formMessage.textContent = 'Sorry, there was an error sending your message. Please try again or contact us directly.';
                formMessage.classList.add('error');
                formMessage.style.display = 'block';
                console.error('EmailJS error:', error);
            })
            .finally(function() {
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
                
                // Hide message after 5 seconds
                setTimeout(() => {
                    formMessage.style.display = 'none';
                }, 5000);
            });
    });
});
