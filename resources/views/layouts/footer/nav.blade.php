<footer class="footer">
    <div class="container-fluid">
        <div class="footer-content">
            <div class="footer-section">
                <h4 class="footer-title">Sistem Bansos</h4>
                <p class="footer-description">Platform Terintegrasi Manajemen Bantuan Sosial dan Donasi</p>
            </div>

            <div class="footer-section">
                <h5 class="footer-subtitle">Tautan Cepat</h5>
                <ul class="footer-links">
                    @if(auth()->user() && auth()->user()->isAdmin())
                        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('users.index') }}">Manajemen User</a></li>
                        <li><a href="{{ route('program-bansos.index') }}">Program Bansos</a></li>
                    @elseif(auth()->user() && auth()->user()->isStaff())
                        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('penerima-bansos.index') }}">Verifikasi Penerima</a></li>
                        <li><a href="{{ route('penyaluran-bansos.index') }}">Penyaluran</a></li>
                    @else
                        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    @endif
                </ul>
            </div>

            <div class="footer-section">
                <h5 class="footer-subtitle">Informasi</h5>
                <ul class="footer-links">
                    <li><a href="#">Kebijakan Privasi</a></li>
                    <li><a href="#">Syarat & Ketentuan</a></li>
                    <li><a href="#">Hubungi Kami</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h5 class="footer-subtitle">Media Sosial</h5>
                <div class="social-links">
                    <a href="#" class="social-link facebook" title="Facebook"><i class="fa fa-facebook"></i></a>
                    <a href="#" class="social-link twitter" title="Twitter"><i class="fa fa-twitter"></i></a>
                    <a href="#" class="social-link instagram" title="Instagram"><i class="fa fa-instagram"></i></a>
                    <a href="#" class="social-link linkedin" title="LinkedIn"><i class="fa fa-linkedin"></i></a>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p class="copyright">
                © <script>document.write(new Date().getFullYear())</script>
                <strong>Sistem Bansos</strong> - Aplikasi Manajemen Bantuan Sosial.
                Dikembangkan dengan <i class="fa fa-heart"></i> untuk Kemajuan Bersama.
            </p>
        </div>
    </div>
</footer>

<style>
    footer.footer {
        background: linear-gradient(135deg, #2d3748 0%, #1a202c 100%);
        color: rgba(255, 255, 255, 0.7);
        padding: 40px 25px 20px;
        border-top: 3px solid #51cbce;
        margin-top: auto;
    }

    .footer-content {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 30px;
        margin-bottom: 30px;
        max-width: 100%;
    }

    .footer-section {
        display: flex;
        flex-direction: column;
    }

    .footer-title {
        font-size: 18px;
        font-weight: 700;
        color: #51cbce;
        margin: 0 0 10px 0;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .footer-description {
        font-size: 13px;
        color: rgba(255, 255, 255, 0.6);
        line-height: 1.6;
        margin: 0;
    }

    .footer-subtitle {
        font-size: 13px;
        font-weight: 700;
        color: white;
        margin: 0 0 15px 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .footer-links {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-links li {
        margin-bottom: 10px;
    }

    .footer-links a {
        color: rgba(255, 255, 255, 0.6);
        text-decoration: none;
        font-size: 13px;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .footer-links a:hover {
        color: #51cbce;
        text-decoration: underline;
        transform: translateX(3px);
    }

    .social-links {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }

    .social-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        background: rgba(81, 203, 206, 0.15);
        color: #51cbce;
        border-radius: 50%;
        text-decoration: none;
        transition: all 0.3s ease;
        font-size: 14px;
    }

    .social-link:hover {
        background: #51cbce;
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 4px 12px rgba(81, 203, 206, 0.3);
    }

    .footer-bottom {
        border-top: 1px solid rgba(81, 203, 206, 0.2);
        padding-top: 20px;
        text-align: center;
    }

    .copyright {
        font-size: 12px;
        color: rgba(255, 255, 255, 0.5);
        margin: 0;
    }

    .copyright strong {
        color: #51cbce;
    }

    .copyright i.fa-heart {
        color: #e74c3c;
        animation: heartbeat 1.5s ease-in-out infinite;
    }

    @keyframes heartbeat {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.2); }
    }

    @media (max-width: 768px) {
        footer.footer {
            padding: 30px 15px 15px;
        }

        .footer-content {
            gap: 20px;
            grid-template-columns: 1fr;
        }

        .copyright {
            font-size: 11px;
        }
    }
</style>
