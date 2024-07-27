document.addEventListener('DOMContentLoaded', function() {
    const modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
        modal.addEventListener('show.bs.modal', function(event) {
            const images = modal.querySelectorAll('.image-slider img');
            let currentIndex = 0;

            function showNextImage() {
                images[currentIndex].classList.remove('active');
                currentIndex = (currentIndex + 1) % images.length;
                images[currentIndex].classList.add('active');
            }

            function showPreviousImage() {
                images[currentIndex].classList.remove('active');
                currentIndex = (currentIndex - 1 + images.length) % images.length;
                images[currentIndex].classList.add('active');
            }

            images[currentIndex].classList.add('active');
            const intervalId = setInterval(showNextImage, 3000);

            modal.addEventListener('hide.bs.modal', () => {
                clearInterval(intervalId);
                images.forEach(image => image.classList.remove('active'));
            });

            modal.querySelector('.next').addEventListener('click', showNextImage);
            modal.querySelector('.prev').addEventListener('click', showPreviousImage);
        });
    });
});

document.getElementById("contactForm").addEventListener("submit", function(event){
    event.preventDefault();

    var formData = new FormData(this);

    fetch("e1.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        var formResponse = document.getElementById("formResponse");
        if (data.status === "success") {
            formResponse.innerHTML = `<div class="alert alert-success">${data.message}</div>`;
        } else {
            formResponse.innerHTML = `<div class="alert alert-danger">${data.message}</div>`;
        }
    })
    .catch(error => {
        console.error("Error:", error);
    });
});


