@extends('layouts.public', ['activePage' => 'welcome', 'title' => 'SEJAHTERA'])

@section('content')
<style>
    .full-page {
        position: relative;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        overflow: hidden;
    }

    .full-page::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1;
    }

    .welcome-content {
        position: relative;
        z-index: 2;
        text-align: center;
        padding: 2rem;
        animation: fadeInUp 1s ease-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .welcome-title {
        font-size: 4rem;
        font-weight: bold;
        color: #fff;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        margin-bottom: 1rem;
    }

    .welcome-subtitle {
        font-size: 1.5rem;
        color: #fff;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
        margin-bottom: 2rem;
        line-height: 1.6;
    }

    .welcome-btn {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        padding: 15px 40px;
        font-size: 1.1rem;
        color: white;
        border-radius: 50px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }

    .welcome-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.3);
        color: white;
    }

    .welcome-btn-secondary {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border: 2px solid white;
    }

    .welcome-btn-secondary:hover {
        background: rgba(255, 255, 255, 0.3);
        color: white;
    }

    .image-counter {
        position: absolute;
        bottom: 20px;
        right: 20px;
        background: rgba(0, 0, 0, 0.5);
        color: white;
        padding: 10px 20px;
        border-radius: 20px;
        z-index: 3;
        font-size: 0.9rem;
    }

    @media (max-width: 768px) {
        .welcome-title {
            font-size: 2.5rem;
        }
        .welcome-subtitle {
            font-size: 1.2rem;
        }
    }
</style>

<div class="full-page section-image"
     data-color="black"
      data-image="{{asset('assets/img/Welcome/Bansos_1.jpeg')}}">
        <div class="content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7 col-md-8">
                        <h1 class="text-center text-white">{{ __('SEJAHTERA') }}</h1>
                        <h1 class="text-center text-white">{{ __('Hadir untuk membantu, dirancang untuk melayani.') }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="image-counter">
        <span id="current-image">1</span> / <span id="total-images">5</span>
    </div>
</div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            const images = [
                '{{asset("assets/img/Welcome/Bansos_1.jpeg")}}',
                '{{asset("assets/img/Welcome/Bansos_2.jpeg")}}',
                '{{asset("assets/img/Welcome/Bansos_3.jpeg")}}',
                '{{asset("assets/img/SenangBantu.jpeg")}}',
                '{{asset("assets/img/BagiBansos.jpeg")}}'
            ];

            let i = 0;
            const $fullPage = $('.full-page');
            const $currentImage = $('#current-image');
            const totalImages = images.length;

            $('#total-images').text(totalImages);

            // Preload images
            images.forEach(function(src) {
                const img = new Image();
                img.src = src;
            });

            // Fade transition function
            function changeImage() {
                $fullPage.css({
                    'opacity': '0.7',
                    'transition': 'opacity 1s ease-in-out'
                });

                setTimeout(function() {
                    i = (i + 1) % images.length;
                    $fullPage.css('background-image', `url(${images[i]})`);
                    $currentImage.text(i + 1);

                    $fullPage.css('opacity', '1');
                }, 500);
            }

            // Change image every 5 seconds
            setInterval(changeImage, 5000);
        });
    </script>
@endpush
