@extends('layouts.public')
@section('title','Home')
@section('content')

<style>
    .hero {
        position: relative;
        width: 100%;
        height: 85vh;
        overflow: hidden;
        color: white;
        margin-top: -50px;
    }

    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.3);
        z-index: 1;
    }

    .hero-content {
        position: absolute;
        top: 50%;
        left: 200px;
        transform: translateY(-50%);
        z-index: 2;
        max-width: 500px;
        color: #fff;
        opacity: 0;
        transform: translate(-30px, -50%);
        transition: all 1s ease;
        text-shadow: 2px 2px 6px rgba(0,0,0,0.5);
    }

    .hero-content.active {
        opacity: 1;
        transform: translate(0, -50%);
    }

    .hero h1 {
        font-size: 3rem;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .hero p {
        font-size: 1.3rem;
        margin-bottom: 20px;
    }

    .hero-content a button {
        padding: 12px 30px;
        font-size: 1.1rem;
        border: none;
        border-radius: 8px;
        background: linear-gradient(135deg, #6c757d, #495057);
        color: white;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 2px 4px 10px rgba(0,0,0,0.3);
    }

    .hero-content a button:hover {
        transform: translateY(-3px);
        box-shadow: 4px 6px 15px rgba(0,0,0,0.4);
    }

    /* Arrows */
    .arrow {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        font-size: 45px;
        color: white;
        cursor: pointer;
        z-index: 3;
        user-select: none;
        transition: 0.3s;
    }

    .arrow:hover { color: #dfe6ff; }
    .arrow-left { left: 20px; }
    .arrow-right { right: 20px; }

        .hero-welcome {
        position: absolute;
        left: 60px;
        z-index: 2;
        font-size: 1.1rem;
        color: #f8f9fa;
        background: rgba(0,0,0,0.25); /* خلفية شفافة للنص */
        padding: 6px 12px;
        border-radius: 6px;
        box-shadow: 1px 2px 6px rgba(0,0,0,0.3);
        font-weight: 500;
        justify-content: center;
        align-items: center;
    }

    /* Responsive */
    @media(max-width: 768px) {
                .hero-welcome {
            left: 20px;
            font-size: 1rem;
        }
        .hero-content { left: 20px; max-width: 90%; }
        .hero h1 { font-size: 2rem; }
        .hero p { font-size: 1.1rem; }
        .arrow { font-size: 35px; }
    }
</style>

<div class="hero" id="hero">

    <div class="hero-overlay"></div>

    <!-- Arrows -->
    <div class="arrow arrow-left" id="prevSlide">&#10094;</div>
    <div class="arrow arrow-right" id="nextSlide">&#10095;</div>


    <!-- Hero content -->
    <div class="hero-content" id="heroContent">
        <h1 id="heroTitle">Men's Fashion Collection</h1>
        <p id="heroDesc">Discover premium clothing for men with modern and elegant styles.</p>

        <a id="btnMen" href="{{ route('men.index') }}" style="display: inline-block;">
            <button>Shop Men</button>
        </a>
        <a id="btnWomen" href="{{ route('women.index') }}" style="display: none;">
            <button>Shop Women</button>
        </a>

</div>
    </div>


      <div>
          <div class="hero-welcome">
        <p>Welcome to our Fashion Store</p>
        </div>
      </div>
<script>
    const hero = document.getElementById('hero');
    const heroContent = document.getElementById('heroContent');

    const backgrounds = [
        "{{Storage::url('imager/slide-03.jpg')}}", // Men
        "{{Storage::url('imager/slide-01.jpg')}}"  // Women
    ];

    const slideText = [
        {
            title: "Men's Fashion Collection",
            desc: "Discover premium clothing for men with modern and elegant styles."
        },
        {
            title: "Women's Fashion Collection",
            desc: "Explore the latest trends in women's clothing with stylish designs."
        }
    ];

    let i = 0;
    const titleEl = document.getElementById('heroTitle');
    const descEl = document.getElementById('heroDesc');
    const btnMen = document.getElementById('btnMen');
    const btnWomen = document.getElementById('btnWomen');

    function updateSlide() {
        hero.style.backgroundImage = `url(${backgrounds[i]})`;
        hero.style.backgroundSize = 'cover';
        hero.style.backgroundPosition = 'center';
        hero.style.backgroundRepeat = 'no-repeat';

        // Hide content, trigger animation
        heroContent.classList.remove('active');
        setTimeout(() => {
            titleEl.textContent = slideText[i].title;
            descEl.textContent = slideText[i].desc;

            // Show appropriate button
            if(i === 0){
                btnMen.style.display = "inline-block";
                btnWomen.style.display = "none";
            } else {
                btnMen.style.display = "none";
                btnWomen.style.display = "inline-block";
            }

            heroContent.classList.add('active');
        }, 200);
    }

    updateSlide();

    // Auto slide
    let autoSlide = setInterval(nextSlide, 5000);

    function nextSlide() {
        i = (i + 1) % backgrounds.length;
        updateSlide();
    }

    function prevSlide() {
        i = (i - 1 + backgrounds.length) % backgrounds.length;
        updateSlide();
    }

    // Arrow events
    document.getElementById("nextSlide").addEventListener("click", () => {
        nextSlide();
        resetAuto();
    });
    document.getElementById("prevSlide").addEventListener("click", () => {
        prevSlide();
        resetAuto();
    });

    function resetAuto() {
        clearInterval(autoSlide);
        autoSlide = setInterval(nextSlide, 5000);
    }
</script>

@endsection
