<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BitTracker - Hyr ose Regjistrohu</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- =====================================================
         INDEX.PHP - FILLIMI I FILE-IT
         Ky file perfshin: Login, Register, Validime, Live Background
         ===================================================== -->
    
    <style>
        /* =====================================================
           GLOBAL STYLES & CSS VARIABLES
           ===================================================== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            /* Primary Colors - Emerald/Teal Theme */
            --primary: #10b981;
            --primary-hover: #059669;
            --primary-light: rgba(16, 185, 129, 0.1);
            --primary-glow: rgba(16, 185, 129, 0.3);
            
            /* Background Colors */
            --bg-dark: #0a1628;
            --bg-card: rgba(15, 30, 50, 0.8);
            --bg-card-solid: #0f1e32;
            --bg-glass: rgba(255, 255, 255, 0.05);
            --bg-input: rgba(255, 255, 255, 0.08);
            
            /* Text Colors */
            --text-primary: #ffffff;
            --text-secondary: rgba(255, 255, 255, 0.7);
            --text-muted: rgba(255, 255, 255, 0.5);
            
            /* Accent Colors */
            --accent-blue: #3b82f6;
            --accent-cyan: #06b6d4;
            --accent-purple: #8b5cf6;
            --accent-pink: #ec4899;
            --accent-orange: #f59e0b;
            --accent-red: #ef4444;
            
            /* Borders & Shadows */
            --border: rgba(255, 255, 255, 0.1);
            --border-hover: rgba(16, 185, 129, 0.5);
            --shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            --shadow-glow: 0 0 60px rgba(16, 185, 129, 0.2);
            
            /* Radius */
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --radius-xl: 24px;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: var(--bg-dark);
            color: var(--text-primary);
            min-height: 100vh;
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* =====================================================
           LIVE ANIMATED BACKGROUND - Fillimi
           ===================================================== */
        .animated-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
            background: linear-gradient(135deg, #0a1628 0%, #0f2744 50%, #0a1628 100%);
        }

        .animated-bg::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(ellipse at 20% 20%, rgba(16, 185, 129, 0.15) 0%, transparent 50%),
                radial-gradient(ellipse at 80% 80%, rgba(6, 182, 212, 0.1) 0%, transparent 50%),
                radial-gradient(ellipse at 40% 60%, rgba(59, 130, 246, 0.08) 0%, transparent 50%);
            animation: bgPulse 8s ease-in-out infinite;
        }

        @keyframes bgPulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.8; transform: scale(1.05); }
        }

        /* Floating Orbs */
        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            animation: float 20s ease-in-out infinite;
        }

        .orb-1 {
            width: 400px;
            height: 400px;
            background: rgba(16, 185, 129, 0.2);
            top: -100px;
            left: -100px;
            animation-delay: 0s;
        }

        .orb-2 {
            width: 500px;
            height: 500px;
            background: rgba(6, 182, 212, 0.15);
            bottom: -150px;
            right: -150px;
            animation-delay: -5s;
        }

        .orb-3 {
            width: 300px;
            height: 300px;
            background: rgba(59, 130, 246, 0.15);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation-delay: -10s;
        }

        .orb-4 {
            width: 250px;
            height: 250px;
            background: rgba(16, 185, 129, 0.12);
            top: 20%;
            right: 10%;
            animation-delay: -3s;
        }

        .orb-5 {
            width: 350px;
            height: 350px;
            background: rgba(6, 182, 212, 0.1);
            bottom: 20%;
            left: 5%;
            animation-delay: -8s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) translateX(0) scale(1); }
            25% { transform: translateY(-30px) translateX(20px) scale(1.1); }
            50% { transform: translateY(20px) translateX(-20px) scale(0.95); }
            75% { transform: translateY(-15px) translateX(-30px) scale(1.05); }
        }

        /* Particles */
        .particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: rgba(16, 185, 129, 0.5);
            border-radius: 50%;
            animation: particleFloat 15s linear infinite;
        }

        .particle:nth-child(even) {
            background: rgba(6, 182, 212, 0.5);
        }

        @keyframes particleFloat {
            0% {
                transform: translateY(100vh) translateX(0) scale(0);
                opacity: 0;
            }
            10% {
                opacity: 1;
                transform: translateY(90vh) translateX(10px) scale(1);
            }
            90% {
                opacity: 1;
                transform: translateY(10vh) translateX(-10px) scale(1);
            }
            100% {
                transform: translateY(-10vh) translateX(0) scale(0);
                opacity: 0;
            }
        }

        /* Grid Lines */
        .grid-lines {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 200%;
            background-image: 
                linear-gradient(rgba(16, 185, 129, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(16, 185, 129, 0.03) 1px, transparent 1px);
            background-size: 80px 80px;
            animation: gridMove 20s linear infinite;
        }

        @keyframes gridMove {
            0% { transform: perspective(500px) rotateX(60deg) translateY(0); }
            100% { transform: perspective(500px) rotateX(60deg) translateY(80px); }
        }

        /* Shooting Stars */
        .shooting-star {
            position: absolute;
            width: 100px;
            height: 2px;
            background: linear-gradient(90deg, transparent, rgba(16, 185, 129, 0.8), transparent);
            animation: shoot 3s ease-in-out infinite;
        }

        .shooting-star:nth-child(1) { top: 10%; left: 20%; animation-delay: 0s; }
        .shooting-star:nth-child(2) { top: 30%; left: 60%; animation-delay: 1s; }
        .shooting-star:nth-child(3) { top: 50%; left: 40%; animation-delay: 2s; }

        @keyframes shoot {
            0% { transform: translateX(-100px) translateY(0); opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { transform: translateX(100vw) translateY(50px); opacity: 0; }
        }
        /* =====================================================
           LIVE ANIMATED BACKGROUND - Fundi
           ===================================================== */

        /* =====================================================
           AUTH CONTAINER STYLES - Fillimi
           ===================================================== */
        .auth-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .auth-card {
            width: 100%;
            max-width: 480px;
            background: var(--bg-card);
            backdrop-filter: blur(20px);
            border: 1px solid var(--border);
            border-radius: var(--radius-xl);
            padding: 3rem;
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
        }

        .auth-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--primary), var(--accent-cyan), var(--primary));
            background-size: 200% 100%;
            animation: shimmer 3s linear infinite;
        }

        @keyframes shimmer {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        /* Logo */
        .logo {
            text-align: center;
            margin-bottom: 2rem;
        }

        .logo-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--primary), var(--accent-cyan));
            border-radius: var(--radius-lg);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            box-shadow: 0 10px 40px rgba(16, 185, 129, 0.3);
            animation: logoGlow 2s ease-in-out infinite alternate;
        }

        @keyframes logoGlow {
            0% { box-shadow: 0 10px 40px rgba(16, 185, 129, 0.3); }
            100% { box-shadow: 0 10px 60px rgba(16, 185, 129, 0.5); }
        }

        .logo-icon svg {
            width: 36px;
            height: 36px;
            fill: white;
        }

        .logo h1 {
            font-size: 2rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--text-primary), var(--primary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -0.5px;
        }

        .logo p {
            color: var(--text-muted);
            font-size: 0.9rem;
            margin-top: 0.5rem;
        }

        /* Tabs */
        .auth-tabs {
            display: flex;
            background: var(--bg-glass);
            border-radius: var(--radius-md);
            padding: 4px;
            margin-bottom: 2rem;
        }

        .auth-tab {
            flex: 1;
            padding: 0.875rem;
            background: transparent;
            border: none;
            color: var(--text-muted);
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            border-radius: var(--radius-sm);
            transition: all 0.3s ease;
        }

        .auth-tab.active {
            background: var(--primary);
            color: white;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
        }

        .auth-tab:hover:not(.active) {
            color: var(--text-primary);
            background: rgba(255, 255, 255, 0.05);
        }

        /* Form Styles */
        .auth-form {
            display: none;
        }

        .auth-form.active {
            display: block;
            animation: fadeSlide 0.4s ease;
        }

        @keyframes fadeSlide {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--text-secondary);
            margin-bottom: 0.5rem;
        }

        .form-input {
            width: 100%;
            padding: 0.875rem 1rem;
            background: var(--bg-input);
            border: 1.5px solid var(--border);
            border-radius: var(--radius-md);
            color: var(--text-primary);
            font-size: 0.95rem;
            font-family: inherit;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            background: rgba(16, 185, 129, 0.05);
            box-shadow: 0 0 0 3px var(--primary-light);
        }

        .form-input::placeholder {
            color: var(--text-muted);
        }

        .form-input.error {
            border-color: var(--accent-red);
            background: rgba(239, 68, 68, 0.05);
        }

        .form-input.success {
            border-color: var(--primary);
        }

        .input-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        /* Error Messages */
        .error-message {
            color: var(--accent-red);
            font-size: 0.8rem;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            animation: shake 0.3s ease;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        .error-message svg {
            width: 14px;
            height: 14px;
        }

        /* Gender Select */
        .gender-select {
            display: flex;
            gap: 0.75rem;
        }

        .gender-option {
            flex: 1;
            padding: 1rem;
            background: var(--bg-glass);
            border: 1.5px solid var(--border);
            border-radius: var(--radius-md);
            cursor: pointer;
            text-align: center;
            transition: all 0.3s ease;
        }

        .gender-option:hover {
            border-color: var(--primary);
            transform: translateY(-2px);
        }

        .gender-option.selected {
            border-color: var(--primary);
            background: var(--primary-light);
            box-shadow: 0 0 20px rgba(16, 185, 129, 0.2);
        }

        .gender-option input {
            display: none;
        }

        .gender-option svg {
            width: 28px;
            height: 28px;
            margin-bottom: 0.5rem;
            color: var(--text-muted);
            transition: color 0.3s ease;
        }

        .gender-option.selected svg {
            color: var(--primary);
        }

        .gender-option span {
            display: block;
            font-size: 0.85rem;
            font-weight: 500;
            color: var(--text-secondary);
        }

        .gender-option.selected span {
            color: var(--primary);
        }

        /* Submit Button */
        .btn {
            width: 100%;
            padding: 1rem 1.5rem;
            font-size: 1rem;
            font-weight: 600;
            font-family: inherit;
            border: none;
            border-radius: var(--radius-md);
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--accent-cyan));
            color: white;
            box-shadow: 0 4px 20px rgba(16, 185, 129, 0.4);
        }

        .btn-primary:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(16, 185, 129, 0.5);
        }

        .btn-primary:active:not(:disabled) {
            transform: translateY(0);
        }

        .btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Password Requirements */
        .password-requirements {
            margin-top: 0.75rem;
            padding: 0.875rem;
            background: var(--bg-glass);
            border-radius: var(--radius-sm);
            border: 1px solid var(--border);
        }

        .password-requirements p {
            font-size: 0.75rem;
            color: var(--text-muted);
            margin-bottom: 0.5rem;
        }

        .requirement {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.8rem;
            color: var(--text-muted);
            margin-bottom: 0.25rem;
            transition: color 0.3s ease;
        }

        .requirement svg {
            width: 14px;
            height: 14px;
            transition: color 0.3s ease;
        }

        .requirement.valid {
            color: var(--primary);
        }

        .requirement.valid svg {
            color: var(--primary);
        }

        /* Success Animation */
        .success-animation {
            display: none;
            text-align: center;
            padding: 2rem;
        }

        .success-animation.show {
            display: block;
            animation: fadeSlide 0.5s ease;
        }

        .success-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary), var(--accent-cyan));
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            animation: pulse 1s ease infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .success-icon svg {
            width: 40px;
            height: 40px;
            color: white;
        }

        /* Hidden class */
        .hidden {
            display: none !important;
        }

        /* Responsive */
        @media (max-width: 600px) {
            .input-row {
                grid-template-columns: 1fr;
            }

            .auth-card {
                padding: 2rem 1.5rem;
                margin: 1rem;
            }
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bg-dark);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--border);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary);
        }
        /* =====================================================
           AUTH CONTAINER STYLES - Fundi
           ===================================================== */
    </style>
</head>
<body>
    <!-- =====================================================
         LIVE ANIMATED BACKGROUND - Fillimi
         ===================================================== -->
    <div class="animated-bg">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
        <div class="orb orb-4"></div>
        <div class="orb orb-5"></div>
        <div class="grid-lines"></div>
        <div class="particles" id="particles"></div>
        <div class="shooting-star"></div>
        <div class="shooting-star"></div>
        <div class="shooting-star"></div>
    </div>
    <!-- =====================================================
         LIVE ANIMATED BACKGROUND - Fundi
         ===================================================== -->

    <!-- =====================================================
         AUTH CONTAINER (Login/Register) - Fillimi
         ===================================================== -->
    <div class="auth-container" id="authContainer">
        <div class="auth-card">
            <!-- Logo -->
            <div class="logo">
                <div class="logo-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                </div>
                <h1>BitTracker</h1>
                <p>Gjurmo shendetin dhe fitneset tend</p>
            </div>

            <!-- Auth Tabs -->
            <div class="auth-tabs">
                <button class="auth-tab active" onclick="switchTab('login')">Hyr</button>
                <button class="auth-tab" onclick="switchTab('register')">Regjistrohu</button>
            </div>

            <!-- Login Form -->
            <form class="auth-form active" id="loginForm" onsubmit="handleLogin(event)">
                <div class="form-group">
                    <label class="form-label" for="loginEmail">Email</label>
                    <input type="email" id="loginEmail" class="form-input" placeholder="email@example.com" autocomplete="email">
                    <div class="error-message hidden" id="loginEmailError"></div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="loginPassword">Fjalekalimi</label>
                    <input type="password" id="loginPassword" class="form-input" placeholder="Shkruaj fjalekalimin" autocomplete="current-password">
                    <div class="error-message hidden" id="loginPasswordError"></div>
                </div>

                <button type="submit" class="btn btn-primary" id="loginBtn">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/>
                        <polyline points="10 17 15 12 10 7"/>
                        <line x1="15" y1="12" x2="3" y2="12"/>
                    </svg>
                    Hyr
                </button>
            </form>

            <!-- Register Form -->
            <form class="auth-form" id="registerForm" onsubmit="handleRegister(event)">
                <div class="form-group">
                    <label class="form-label" for="regEmail">Email</label>
                    <input type="email" id="regEmail" class="form-input" placeholder="email@example.com" oninput="validateEmail(this)">
                    <div class="error-message hidden" id="regEmailError"></div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="regPassword">Fjalekalimi</label>
                    <input type="password" id="regPassword" class="form-input" placeholder="Krijo fjalekalimin" oninput="validatePassword(this)">
                    <div class="password-requirements" id="passwordReqs">
                        <p>Fjalekalimi duhet te kete:</p>
                        <div class="requirement" id="reqLength">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/></svg>
                            Minimumi 8 karaktere
                        </div>
                        <div class="requirement" id="reqUpper">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/></svg>
                            Te pakten 1 shkronje te madhe
                        </div>
                        <div class="requirement" id="reqNumber">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/></svg>
                            Te pakten 1 numer
                        </div>
                    </div>
                </div>

                <div class="input-row">
                    <div class="form-group">
                        <label class="form-label" for="regHeight">Gjatesia (cm)</label>
                        <input type="number" id="regHeight" class="form-input" placeholder="170" min="120" max="230" oninput="validateField(this, 120, 230)">
                        <div class="error-message hidden" id="regHeightError"></div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="regWeight">Pesha (kg)</label>
                        <input type="number" id="regWeight" class="form-input" placeholder="70" min="30" max="250" oninput="validateField(this, 30, 250)">
                        <div class="error-message hidden" id="regWeightError"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="regAge">Mosha</label>
                    <input type="number" id="regAge" class="form-input" placeholder="25" min="10" max="100" oninput="validateField(this, 10, 100)">
                    <div class="error-message hidden" id="regAgeError"></div>
                </div>

                <div class="form-group">
                    <label class="form-label">Gjinia</label>
                    <div class="gender-select">
                        <label class="gender-option" onclick="selectGender(this, 'mashkull')">
                            <input type="radio" name="gender" value="mashkull">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="10" cy="14" r="5"/>
                                <path d="M19 5l-4.5 4.5"/>
                                <path d="M15 5h4v4"/>
                            </svg>
                            <span>Mashkull</span>
                        </label>
                        <label class="gender-option" onclick="selectGender(this, 'femer')">
                            <input type="radio" name="gender" value="femer">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="8" r="5"/>
                                <path d="M12 13v8"/>
                                <path d="M9 18h6"/>
                            </svg>
                            <span>Femer</span>
                        </label>
                    </div>
                    <div class="error-message hidden" id="regGenderError"></div>
                </div>

                <button type="submit" class="btn btn-primary" id="registerBtn" disabled>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                        <circle cx="8.5" cy="7" r="4"/>
                        <line x1="20" y1="8" x2="20" y2="14"/>
                        <line x1="23" y1="11" x2="17" y2="11"/>
                    </svg>
                    Regjistrohu
                </button>
            </form>

            <!-- Success Animation -->
            <div class="success-animation" id="successAnimation">
                <div class="success-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                </div>
                <h2 style="color: var(--primary); margin-bottom: 0.5rem;">Sukses!</h2>
                <p style="color: var(--text-muted);">Duke te ridrejtuar...</p>
            </div>
        </div>
    </div>
    <!-- =====================================================
         AUTH CONTAINER (Login/Register) - Fundi
         ===================================================== -->

    <!-- =====================================================
         JAVASCRIPT - Fillimi
         ===================================================== -->
    <script>
        // =====================================================
        // PARTICLES ANIMATION - Krijo partikulat
        // =====================================================
        function createParticles() {
            const container = document.getElementById('particles');
            for (let i = 0; i < 40; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 15 + 's';
                particle.style.animationDuration = (15 + Math.random() * 10) + 's';
                particle.style.width = (2 + Math.random() * 4) + 'px';
                particle.style.height = particle.style.width;
                container.appendChild(particle);
            }
        }
        createParticles();

        // =====================================================
        // EMAIL VALIDATION - Domains te lejuara dhe te bllokuara
        // =====================================================
        const allowedDomains = [
            'gmail.com', 
            'outlook.com', 
            'yahoo.com', 
            'icloud.com', 
            'hotmail.com',
            'protonmail.com',
            'live.com'
        ];
        
        const blockedDomains = [
            '10minutemail.com', 
            'tempmail.com', 
            'guerrillamail.com', 
            'mailinator.com', 
            'throwaway.email',
            'temp-mail.org',
            'fakeinbox.com',
            'trashmail.com',
            'yopmail.com',
            'getairmail.com'
        ];

        function validateEmail(input) {
            const email = input.value.trim().toLowerCase();
            const errorEl = document.getElementById('regEmailError');
            
            // Regex validation
            const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            
            if (!email) {
                showError(errorEl, '');
                input.classList.remove('error', 'success');
                checkFormValidity();
                return false;
            }

            if (!emailRegex.test(email)) {
                showError(errorEl, 'Formati i emailit nuk eshte i vlefshem');
                input.classList.add('error');
                input.classList.remove('success');
                checkFormValidity();
                return false;
            }

            const domain = email.split('@')[1];

            // Check blocked domains
            if (blockedDomains.some(blocked => domain.includes(blocked))) {
                showError(errorEl, 'Email-at e perkohshme nuk lejohen');
                input.classList.add('error');
                input.classList.remove('success');
                checkFormValidity();
                return false;
            }

            // Check allowed domains
            if (!allowedDomains.includes(domain)) {
                showError(errorEl, 'Perdor: gmail.com, outlook.com, yahoo.com, icloud.com, hotmail.com, protonmail.com ose live.com');
                input.classList.add('error');
                input.classList.remove('success');
                checkFormValidity();
                return false;
            }

            hideError(errorEl);
            input.classList.remove('error');
            input.classList.add('success');
            checkFormValidity();
            return true;
        }

        // =====================================================
        // PASSWORD VALIDATION - Verifikimi i fjalekalimit
        // =====================================================
        function validatePassword(input) {
            const password = input.value;
            const reqLength = document.getElementById('reqLength');
            const reqUpper = document.getElementById('reqUpper');
            const reqNumber = document.getElementById('reqNumber');

            // Length check
            if (password.length >= 8) {
                reqLength.classList.add('valid');
                reqLength.innerHTML = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg> Minimumi 8 karaktere';
            } else {
                reqLength.classList.remove('valid');
                reqLength.innerHTML = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/></svg> Minimumi 8 karaktere';
            }

            // Uppercase check
            if (/[A-Z]/.test(password)) {
                reqUpper.classList.add('valid');
                reqUpper.innerHTML = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg> Te pakten 1 shkronje te madhe';
            } else {
                reqUpper.classList.remove('valid');
                reqUpper.innerHTML = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/></svg> Te pakten 1 shkronje te madhe';
            }

            // Number check
            if (/[0-9]/.test(password)) {
                reqNumber.classList.add('valid');
                reqNumber.innerHTML = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg> Te pakten 1 numer';
            } else {
                reqNumber.classList.remove('valid');
                reqNumber.innerHTML = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/></svg> Te pakten 1 numer';
            }

            checkFormValidity();
            return password.length >= 8 && /[A-Z]/.test(password) && /[0-9]/.test(password);
        }

        // =====================================================
        // FIELD VALIDATION - Verifikimi i fushave
        // =====================================================
        function validateField(input, min, max) {
            const value = parseInt(input.value);
            const errorId = input.id + 'Error';
            const errorEl = document.getElementById(errorId);

            if (!input.value) {
                hideError(errorEl);
                input.classList.remove('error', 'success');
                checkFormValidity();
                return false;
            }

            if (isNaN(value) || value < min || value > max) {
                showError(errorEl, `Vlera duhet te jete mes ${min} dhe ${max}`);
                input.classList.add('error');
                input.classList.remove('success');
                checkFormValidity();
                return false;
            }

            hideError(errorEl);
            input.classList.remove('error');
            input.classList.add('success');
            checkFormValidity();
            return true;
        }

        // =====================================================
        // HELPER FUNCTIONS - Funksione ndihmese
        // =====================================================
        function showError(el, message) {
            if (el && message) {
                el.innerHTML = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg> ' + message;
                el.classList.remove('hidden');
            } else if (el) {
                el.classList.add('hidden');
            }
        }

        function hideError(el) {
            if (el) {
                el.classList.add('hidden');
            }
        }

        // =====================================================
        // GENDER SELECTION - Zgjedhja e gjinise
        // =====================================================
        let selectedGender = '';

        function selectGender(el, gender) {
            document.querySelectorAll('.gender-option').forEach(opt => opt.classList.remove('selected'));
            el.classList.add('selected');
            selectedGender = gender;
            hideError(document.getElementById('regGenderError'));
            checkFormValidity();
        }

        // =====================================================
        // FORM VALIDITY CHECK - Kontrollo validitetin e formes
        // =====================================================
        function checkFormValidity() {
            const email = document.getElementById('regEmail').value.trim().toLowerCase();
            const password = document.getElementById('regPassword').value;
            const height = document.getElementById('regHeight').value;
            const weight = document.getElementById('regWeight').value;
            const age = document.getElementById('regAge').value;

            const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            const domain = email.split('@')[1] || '';
            
            const isEmailValid = emailRegex.test(email) && 
                                 allowedDomains.includes(domain) && 
                                 !blockedDomains.some(blocked => domain.includes(blocked));
            const isPasswordValid = password.length >= 8 && /[A-Z]/.test(password) && /[0-9]/.test(password);
            const isHeightValid = height >= 120 && height <= 230;
            const isWeightValid = weight >= 30 && weight <= 250;
            const isAgeValid = age >= 10 && age <= 100;
            const isGenderValid = selectedGender !== '';

            const isValid = isEmailValid && isPasswordValid && isHeightValid && isWeightValid && isAgeValid && isGenderValid;
            document.getElementById('registerBtn').disabled = !isValid;
        }

        // =====================================================
        // TAB SWITCHING - Ndryshimi i tab-ave
        // =====================================================
        function switchTab(tab) {
            document.querySelectorAll('.auth-tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.auth-form').forEach(f => f.classList.remove('active'));
            document.getElementById('successAnimation').classList.remove('show');

            if (tab === 'login') {
                document.querySelector('.auth-tab:first-child').classList.add('active');
                document.getElementById('loginForm').classList.add('active');
            } else {
                document.querySelector('.auth-tab:last-child').classList.add('active');
                document.getElementById('registerForm').classList.add('active');
            }
        }

        // =====================================================
        // LOGIN HANDLER - Trajto hyrjen
        // =====================================================
        function handleLogin(e) {
            e.preventDefault();
            const email = document.getElementById('loginEmail').value.trim().toLowerCase();
            const password = document.getElementById('loginPassword').value;

            // Hide previous errors
            hideError(document.getElementById('loginEmailError'));
            hideError(document.getElementById('loginPasswordError'));

            // Validate email format
            const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if (!emailRegex.test(email)) {
                showError(document.getElementById('loginEmailError'), 'Formati i emailit nuk eshte i vlefshem');
                return;
            }

            // Check if user exists in localStorage
            const userData = localStorage.getItem('bittracker_user');
            if (!userData) {
                showError(document.getElementById('loginEmailError'), 'Nuk ekziston asnje llogari. Regjistrohu fillimisht.');
                return;
            }

            const user = JSON.parse(userData);
            if (user.email !== email) {
                showError(document.getElementById('loginEmailError'), 'Email-i nuk u gjet');
                return;
            }

            if (user.password !== password) {
                showError(document.getElementById('loginPasswordError'), 'Fjalekalimi eshte i gabuar');
                return;
            }

            // Success - show animation and redirect
            showSuccessAndRedirect();
        }

        // =====================================================
        // REGISTER HANDLER - Trajto regjistrimin
        // =====================================================
        function handleRegister(e) {
            e.preventDefault();

            const email = document.getElementById('regEmail').value.trim().toLowerCase();
            const password = document.getElementById('regPassword').value;
            const height = parseInt(document.getElementById('regHeight').value);
            const weight = parseInt(document.getElementById('regWeight').value);
            const age = parseInt(document.getElementById('regAge').value);

            if (!selectedGender) {
                showError(document.getElementById('regGenderError'), 'Zgjidh gjinine');
                return;
            }

            // Check if email already exists
            const existingUser = localStorage.getItem('bittracker_user');
            if (existingUser) {
                const user = JSON.parse(existingUser);
                if (user.email === email) {
                    showError(document.getElementById('regEmailError'), 'Ky email eshte i regjistruar. Provo te hysh.');
                    return;
                }
            }

            // Save to localStorage
            const userData = {
                email: email,
                password: password,
                height: height,
                weight: weight,
                age: age,
                gender: selectedGender,
                avatar: null,
                createdAt: new Date().toISOString()
            };

            localStorage.setItem('bittracker_user', JSON.stringify(userData));
            localStorage.setItem('bittracker_daily_foods', JSON.stringify([]));

            // Success - show animation and redirect
            showSuccessAndRedirect();
        }

        // =====================================================
        // SUCCESS AND REDIRECT - Sukses dhe ridrejtim
        // =====================================================
        function showSuccessAndRedirect() {
            // Hide forms
            document.querySelectorAll('.auth-form').forEach(f => f.classList.remove('active'));
            document.querySelector('.auth-tabs').style.display = 'none';
            
            // Show success animation
            document.getElementById('successAnimation').classList.add('show');
            
            // Redirect after 1.5 seconds
            setTimeout(() => {
                window.location.href = 'dashboard.php';
            }, 1500);
        }

        // =====================================================
        // CHECK SESSION - Kontrollo sesionin
        // =====================================================
        function checkSession() {
            const userData = localStorage.getItem('bittracker_user');
            // If user is logged in, redirect to dashboard
            // Uncomment below if you want auto-redirect
            // if (userData) {
            //     window.location.href = 'dashboard.php';
            // }
        }

        // Initialize
        checkSession();
    </script>
    <!-- =====================================================
         JAVASCRIPT - Fundi
         ===================================================== -->
</body>
</html>
<!-- =====================================================
     INDEX.PHP - FUNDI I FILE-IT
     ===================================================== -->
