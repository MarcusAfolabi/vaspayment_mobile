<section>
    <div class="slider">
        <div class="slides">
            <div class="slide active">
                <img src="https://img.freepik.com/free-vector/flat-design-food-facebook-cover_23-2149108159.jpg?t=st=1728413157~exp=1728416757~hmac=a88c52867ddfcfd33ed6ab4c85d9b062c7b8603dfb6e38d333ff8c375c4c9e20&w=1480" style=" width: 100%; height:200px" alt="Image 1">
            </div>
            <div class="slide">
                <img src="https://img.freepik.com/free-vector/gradient-charity-event-twitch-header-template_23-2149383852.jpg?t=st=1728413243~exp=1728416843~hmac=3f7ce93669bd8a4b62f66d6f91538a42127ee538642842215d428310c89e80f8&w=1480" style=" width: 100%; height:200px" alt="Image 2">
            </div>
            <div class="slide">
                <img src="https://via.placeholder.com/400x200/7fff7f/ffffff?text=Image+3" alt="Image 3">
            </div>
        </div>
        <div class="indicators">
            <span class="indicator active" onclick="showSlide(0)"></span>
            <span class="indicator" onclick="showSlide(1)"></span>
            <span class="indicator" onclick="showSlide(2)"></span>
        </div>
    </div>
</section>
<style>
    .slider {
        position: relative;
        overflow: hidden;
        width: 100%;
        max-width: 400px;
        /* Adjust as needed */
        margin: auto;
    }

    .slides {
        display: flex;
        transition: transform 0.5s ease-in-out;
    }

    .slide {
        min-width: 100%;
        box-sizing: border-box;
    }



    button {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background-color: rgba(255, 255, 255, 0.8);
        border: none;
        cursor: pointer;
        padding: 10px;
        font-size: 18px;
    }

    .prev {
        left: 10px;
    }

    .next {
        right: 10px;
    }

    .indicators {
        text-align: center;
        margin-top: 10px;
    }

    .indicator {
        display: inline-block;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background-color: lightgray;
        margin: 0 5px;
        cursor: pointer;
    }

    .indicator.active {
        background-color: gray;
    }
</style>
<script>
    const slides = document.querySelectorAll('.slide');
    const indicators = document.querySelectorAll('.indicator');
    let currentSlide = 0;

    function showSlide(index) {
        currentSlide = index;
        slides.forEach((slide, i) => {
            slide.classList.remove('active');
            if (i === currentSlide) {
                slide.classList.add('active');
            }
        });

        // Update the transform to slide
        const offset = currentSlide * -100;
        document.querySelector('.slides').style.transform = `translateX(${offset}%)`;

        // Update indicators
        indicators.forEach((indicator, i) => {
            indicator.classList.remove('active');
            if (i === currentSlide) {
                indicator.classList.add('active');
            }
        });
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % slides.length;
        showSlide(currentSlide);
    }

    function prevSlide() {
        currentSlide = (currentSlide - 1 + slides.length) % slides.length;
        showSlide(currentSlide);
    }

    // Autoplay functionality
    setInterval(nextSlide, 4000); // 4 seconds
</script>