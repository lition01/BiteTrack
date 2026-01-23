<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BitTracker - Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- =====================================================
         DASHBOARD.PHP - FILLIMI I FILE-IT
         Ky file perfshin: Dashboard, Stats, Nutrition, Profile
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
            /* Primary Colors - Emerald/Teal Theme (njelloj si index) */
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
           ANIMATED BACKGROUND (njelloj si index por me i lehte)
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
                radial-gradient(ellipse at 20% 20%, rgba(16, 185, 129, 0.08) 0%, transparent 50%),
                radial-gradient(ellipse at 80% 80%, rgba(6, 182, 212, 0.06) 0%, transparent 50%);
            animation: bgPulse 10s ease-in-out infinite;
        }

        @keyframes bgPulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }

        /* Floating Orbs (me pak dhe me te buta) */
        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            animation: float 25s ease-in-out infinite;
        }

        .orb-1 {
            width: 300px;
            height: 300px;
            background: rgba(16, 185, 129, 0.1);
            top: -100px;
            right: -100px;
        }

        .orb-2 {
            width: 400px;
            height: 400px;
            background: rgba(6, 182, 212, 0.08);
            bottom: -150px;
            left: -150px;
            animation-delay: -8s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) translateX(0); }
            50% { transform: translateY(-20px) translateX(10px); }
        }

        /* =====================================================
           SIDEBAR STYLES - Fillimi
           ===================================================== */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 280px;
            height: 100vh;
            background: var(--bg-card);
            backdrop-filter: blur(20px);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            z-index: 100;
            transition: transform 0.3s ease;
        }

        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--border);
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 0.875rem;
        }

        .sidebar-logo-icon {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, var(--primary), var(--accent-cyan));
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 20px rgba(16, 185, 129, 0.3);
        }

        .sidebar-logo-icon svg {
            width: 24px;
            height: 24px;
            fill: white;
        }

        .sidebar-logo h2 {
            font-size: 1.25rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--text-primary), var(--primary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Sidebar Navigation */
        .sidebar-nav {
            flex: 1;
            padding: 1rem 0.75rem;
            overflow-y: auto;
        }

        .nav-section {
            margin-bottom: 1.5rem;
        }

        .nav-section-title {
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--text-muted);
            padding: 0 1rem;
            margin-bottom: 0.75rem;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 0.875rem;
            padding: 0.875rem 1rem;
            border-radius: var(--radius-md);
            color: var(--text-secondary);
            cursor: pointer;
            transition: all 0.2s ease;
            margin-bottom: 0.25rem;
        }

        .nav-item:hover {
            background: var(--bg-glass);
            color: var(--text-primary);
        }

        .nav-item.active {
            background: var(--primary-light);
            color: var(--primary);
        }

        .nav-item svg {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
        }

        .nav-item span {
            font-size: 0.9rem;
            font-weight: 500;
        }

        /* Sidebar User */
        .sidebar-user {
            padding: 1rem 0.75rem;
            border-top: 1px solid var(--border);
        }

        .user-card {
            display: flex;
            align-items: center;
            gap: 0.875rem;
            padding: 1rem;
            background: var(--bg-glass);
            border-radius: var(--radius-md);
        }

        .user-avatar {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, var(--primary), var(--accent-cyan));
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            font-weight: 700;
            color: white;
            cursor: pointer;
            transition: transform 0.2s ease;
            position: relative;
            overflow: hidden;
        }

        .user-avatar:hover {
            transform: scale(1.05);
        }

        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: var(--radius-md);
        }

        .user-info {
            flex: 1;
            min-width: 0;
        }

        .user-name {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-primary);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-email {
            font-size: 0.75rem;
            color: var(--text-muted);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Buttons */
        .btn {
            width: 100%;
            padding: 0.875rem 1.5rem;
            font-size: 0.9rem;
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

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(16, 185, 129, 0.5);
        }

        .btn-secondary {
            background: var(--bg-glass);
            border: 1.5px solid var(--border);
            color: var(--text-primary);
        }

        .btn-secondary:hover {
            border-color: var(--accent-red);
            color: var(--accent-red);
            background: rgba(239, 68, 68, 0.1);
        }
        /* =====================================================
           SIDEBAR STYLES - Fundi
           ===================================================== */

        /* =====================================================
           MAIN CONTENT STYLES - Fillimi
           ===================================================== */
        .main-content {
            margin-left: 280px;
            padding: 2rem;
            min-height: 100vh;
        }

        /* Dashboard Header */
        .dashboard-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 2rem;
        }

        .header-left h1 {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.25rem;
        }

        .header-left p {
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .mobile-menu-btn {
            display: none;
            width: 44px;
            height: 44px;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            cursor: pointer;
            align-items: center;
            justify-content: center;
        }

        .mobile-menu-btn svg {
            width: 24px;
            height: 24px;
            color: var(--text-primary);
        }

        /* Dashboard Sections */
        .dashboard-section {
            display: none;
            animation: fadeSlide 0.4s ease;
        }

        .dashboard-section.active {
            display: block;
        }

        @keyframes fadeSlide {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Stats Cards Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: var(--bg-card);
            backdrop-filter: blur(20px);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 1.5rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: var(--card-accent, var(--primary));
        }

        .stat-card:hover {
            transform: translateY(-4px);
            border-color: var(--border-hover);
            box-shadow: var(--shadow-glow);
        }

        .stat-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            background: var(--icon-bg, var(--primary-light));
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .stat-icon svg {
            width: 24px;
            height: 24px;
            color: var(--icon-color, var(--primary));
        }

        .stat-badge {
            font-size: 0.75rem;
            padding: 0.25rem 0.625rem;
            border-radius: 20px;
            font-weight: 500;
        }

        .stat-badge.good {
            background: rgba(16, 185, 129, 0.15);
            color: var(--primary);
        }

        .stat-badge.warning {
            background: rgba(245, 158, 11, 0.15);
            color: var(--accent-orange);
        }

        .stat-badge.danger {
            background: rgba(239, 68, 68, 0.15);
            color: var(--accent-red);
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.25rem;
        }

        .stat-label {
            font-size: 0.875rem;
            color: var(--text-muted);
        }

        /* Card Variants */
        .stat-card.blue { --card-accent: var(--accent-blue); --icon-bg: rgba(59, 130, 246, 0.15); --icon-color: var(--accent-blue); }
        .stat-card.cyan { --card-accent: var(--accent-cyan); --icon-bg: rgba(6, 182, 212, 0.15); --icon-color: var(--accent-cyan); }
        .stat-card.purple { --card-accent: var(--accent-purple); --icon-bg: rgba(139, 92, 246, 0.15); --icon-color: var(--accent-purple); }
        .stat-card.orange { --card-accent: var(--accent-orange); --icon-bg: rgba(245, 158, 11, 0.15); --icon-color: var(--accent-orange); }

        /* Large Cards */
        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 1.5rem;
        }

        .card {
            background: var(--bg-card);
            backdrop-filter: blur(20px);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 1.5rem;
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        /* Data Grid */
        .data-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .data-item {
            padding: 1rem;
            background: var(--bg-glass);
            border-radius: var(--radius-md);
            border: 1px solid var(--border);
        }

        .data-item-label {
            font-size: 0.8rem;
            color: var(--text-muted);
            margin-bottom: 0.25rem;
        }

        .data-item-value {
            font-weight: 600;
            color: var(--text-primary);
        }

        /* Health Status Card */
        .health-status {
            text-align: center;
            padding: 2rem;
        }

        .health-meter {
            width: 160px;
            height: 160px;
            margin: 0 auto 1.5rem;
            position: relative;
        }

        .health-meter svg {
            transform: rotate(-90deg);
        }

        .health-meter circle {
            fill: none;
            stroke-width: 12;
        }

        .health-meter .bg {
            stroke: var(--bg-glass);
        }

        .health-meter .progress {
            stroke: var(--primary);
            stroke-linecap: round;
            transition: stroke-dashoffset 1s ease, stroke 0.5s ease;
        }

        .health-meter-value {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .health-meter-value .value {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--text-primary);
        }

        .health-meter-value .label {
            font-size: 0.875rem;
            color: var(--text-muted);
        }

        .health-status-text {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        .health-status-desc {
            color: var(--text-muted);
            font-size: 0.875rem;
        }
        /* =====================================================
           MAIN CONTENT STYLES - Fundi
           ===================================================== */

        /* =====================================================
           NUTRITION SECTION STYLES - Fillimi
           ===================================================== */
        .daily-calories {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 1.5rem;
            background: linear-gradient(135deg, var(--primary), var(--accent-cyan));
            border-radius: var(--radius-md);
            margin-bottom: 1.5rem;
        }

        .daily-calories-icon {
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .daily-calories-icon svg {
            width: 26px;
            height: 26px;
            color: white;
        }

        .daily-calories-info h3 {
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
        }

        .daily-calories-info p {
            font-size: 0.875rem;
            color: rgba(255, 255, 255, 0.8);
        }

        .calories-progress {
            margin-bottom: 1.5rem;
        }

        .calories-progress-bar {
            height: 10px;
            background: var(--bg-glass);
            border-radius: 5px;
            overflow: hidden;
            margin-bottom: 0.5rem;
        }

        .calories-progress-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--primary), var(--accent-cyan));
            border-radius: 5px;
            transition: width 0.5s ease;
        }

        .calories-progress-text {
            display: flex;
            justify-content: space-between;
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        /* Food Categories */
        .food-categories {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .food-category {
            background: var(--bg-glass);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            padding: 1rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .food-category:hover {
            border-color: var(--primary);
            transform: translateY(-2px);
        }

        .food-category.active {
            border-color: var(--primary);
            background: var(--primary-light);
        }

        .food-category-icon {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .food-category-name {
            font-size: 0.8rem;
            color: var(--text-secondary);
            font-weight: 500;
        }

        /* Food List */
        .food-list {
            max-height: 400px;
            overflow-y: auto;
        }

        .food-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem;
            background: var(--bg-glass);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            margin-bottom: 0.75rem;
            transition: all 0.2s ease;
        }

        .food-item:hover {
            border-color: var(--border-hover);
        }

        .food-item-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .food-item-icon {
            width: 44px;
            height: 44px;
            background: var(--bg-glass);
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .food-item-name {
            font-weight: 500;
            color: var(--text-primary);
            margin-bottom: 0.125rem;
        }

        .food-item-details {
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        .food-item-calories {
            font-size: 1rem;
            font-weight: 600;
            color: var(--accent-orange);
        }

        .food-item-actions {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .food-item-btn {
            width: 36px;
            height: 36px;
            background: var(--bg-glass);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            color: var(--text-muted);
        }

        .food-item-btn:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        .food-item-btn.delete:hover {
            border-color: var(--accent-red);
            color: var(--accent-red);
            background: rgba(239, 68, 68, 0.1);
        }

        .food-item-btn svg {
            width: 18px;
            height: 18px;
        }

        /* Add Food Button */
        .add-food-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.875rem;
            background: var(--bg-glass);
            border: 2px dashed var(--border);
            border-radius: var(--radius-md);
            color: var(--text-muted);
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 1rem;
        }

        .add-food-btn:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: var(--primary-light);
        }

        .add-food-btn svg {
            width: 20px;
            height: 20px;
        }
        /* =====================================================
           NUTRITION SECTION STYLES - Fundi
           ===================================================== */

        /* =====================================================
           PROFILE SECTION STYLES - Fillimi
           ===================================================== */
        .profile-header {
            display: flex;
            align-items: center;
            gap: 2rem;
            padding: 2rem;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            margin-bottom: 2rem;
        }

        .profile-avatar-large {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, var(--primary), var(--accent-cyan));
            border-radius: var(--radius-xl);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            font-weight: 700;
            color: white;
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }

        .profile-avatar-large img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-avatar-edit {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 0.5rem;
            background: rgba(0, 0, 0, 0.6);
            color: white;
            font-size: 0.75rem;
            text-align: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .profile-avatar-large:hover .profile-avatar-edit {
            opacity: 1;
        }

        .profile-info h2 {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.25rem;
        }

        .profile-info .email {
            color: var(--text-muted);
            margin-bottom: 1rem;
        }

        .profile-badges {
            display: flex;
            gap: 0.75rem;
        }

        .profile-badge {
            padding: 0.375rem 0.875rem;
            background: var(--primary-light);
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            color: var(--primary);
        }

        /* Profile Form */
        .profile-form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }

        .profile-form-group {
            margin-bottom: 1.25rem;
        }

        .profile-form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--text-secondary);
            margin-bottom: 0.5rem;
        }

        .profile-form-input {
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

        .profile-form-input:focus {
            outline: none;
            border-color: var(--primary);
            background: rgba(16, 185, 129, 0.05);
            box-shadow: 0 0 0 3px var(--primary-light);
        }

        .profile-form-input:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }
        /* =====================================================
           PROFILE SECTION STYLES - Fundi
           ===================================================== */

        /* =====================================================
           MODAL STYLES - Fillimi
           ===================================================== */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(4px);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal-overlay.active {
            display: flex;
        }

        .modal {
            background: var(--bg-card-solid);
            border: 1px solid var(--border);
            border-radius: var(--radius-xl);
            padding: 2rem;
            width: 100%;
            max-width: 500px;
            max-height: 90vh;
            overflow-y: auto;
            animation: modalSlide 0.3s ease;
        }

        @keyframes modalSlide {
            from { opacity: 0; transform: translateY(-20px) scale(0.95); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }

        .modal-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        .modal-close {
            width: 36px;
            height: 36px;
            background: var(--bg-glass);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            transition: all 0.2s ease;
        }

        .modal-close:hover {
            border-color: var(--accent-red);
            color: var(--accent-red);
        }

        .modal-close svg {
            width: 18px;
            height: 18px;
        }

        .modal-actions {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .modal-actions .btn {
            flex: 1;
        }

        /* Form inputs for modals */
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

        .input-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }
        /* =====================================================
           MODAL STYLES - Fundi
           ===================================================== */

        /* =====================================================
           RESPONSIVE STYLES - Fillimi
           ===================================================== */
        @media (max-width: 1200px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .content-grid {
                grid-template-columns: 1fr;
            }

            .food-categories {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        @media (max-width: 900px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .mobile-menu-btn {
                display: flex;
            }

            .profile-header {
                flex-direction: column;
                text-align: center;
            }

            .profile-badges {
                justify-content: center;
            }

            .profile-form-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 600px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .food-categories {
                grid-template-columns: repeat(2, 1fr);
            }

            .main-content {
                padding: 1rem;
            }

            .data-grid {
                grid-template-columns: 1fr;
            }

            .input-row {
                grid-template-columns: 1fr;
            }
        }
        /* =====================================================
           RESPONSIVE STYLES - Fundi
           ===================================================== */

        /* =====================================================
           UTILITY STYLES
           ===================================================== */
        .hidden {
            display: none !important;
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

        /* Toast Notification */
        .toast {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            padding: 1rem 1.5rem;
            background: var(--bg-card-solid);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            color: var(--text-primary);
            font-weight: 500;
            box-shadow: var(--shadow);
            z-index: 2000;
            animation: toastSlide 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .toast.success {
            border-color: var(--primary);
        }

        .toast.success::before {
            content: '✓';
            width: 24px;
            height: 24px;
            background: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            color: white;
        }

        @keyframes toastSlide {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
    </style>
</head>
<body>
    <!-- =====================================================
         ANIMATED BACKGROUND - Fillimi
         ===================================================== -->
    <div class="animated-bg">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
    </div>
    <!-- =====================================================
         ANIMATED BACKGROUND - Fundi
         ===================================================== -->

    <!-- =====================================================
         SIDEBAR - Fillimi
         ===================================================== -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">
                <div class="sidebar-logo-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                </div>
                <h2>BitTracker</h2>
            </div>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section">
                <div class="nav-section-title">Kryesore</div>
                <div class="nav-item active" onclick="switchSection('overview')">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="7" height="7"/>
                        <rect x="14" y="3" width="7" height="7"/>
                        <rect x="14" y="14" width="7" height="7"/>
                        <rect x="3" y="14" width="7" height="7"/>
                    </svg>
                    <span>Paneli</span>
                </div>
                <div class="nav-item" onclick="switchSection('nutrition')">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M18 8h1a4 4 0 0 1 0 8h-1"/>
                        <path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"/>
                        <line x1="6" y1="1" x2="6" y2="4"/>
                        <line x1="10" y1="1" x2="10" y2="4"/>
                        <line x1="14" y1="1" x2="14" y2="4"/>
                    </svg>
                    <span>Ushqimi</span>
                </div>
            </div>

            <div class="nav-section">
                <div class="nav-section-title">Cilesimet</div>
                <div class="nav-item" onclick="switchSection('profile')">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                        <circle cx="12" cy="7" r="4"/>
                    </svg>
                    <span>Profili</span>
                </div>
            </div>
        </nav>

        <div class="sidebar-user">
            <div class="user-card">
                <div class="user-avatar" id="sidebarAvatar" onclick="openAvatarModal()">
                    <span id="sidebarAvatarText">U</span>
                </div>
                <div class="user-info">
                    <div class="user-name" id="sidebarUserName">Perdoruesi</div>
                    <div class="user-email" id="sidebarUserEmail">email@example.com</div>
                </div>
            </div>
            <button class="btn btn-secondary" onclick="handleLogout()" style="margin-top: 1rem;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                    <polyline points="16 17 21 12 16 7"/>
                    <line x1="21" y1="12" x2="9" y2="12"/>
                </svg>
                Dil
            </button>
        </div>
    </aside>
    <!-- =====================================================
         SIDEBAR - Fundi
         ===================================================== -->

    <!-- =====================================================
         MAIN CONTENT - Fillimi
         ===================================================== -->
    <main class="main-content">
        <!-- Header -->
        <header class="dashboard-header">
            <div class="header-left">
                <h1 id="dashboardGreeting">Mire se erdhe!</h1>
                <p id="dashboardDate"></p>
            </div>
            <div class="header-right">
                <button class="mobile-menu-btn" onclick="toggleSidebar()">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="3" y1="12" x2="21" y2="12"/>
                        <line x1="3" y1="6" x2="21" y2="6"/>
                        <line x1="3" y1="18" x2="21" y2="18"/>
                    </svg>
                </button>
            </div>
        </header>

        <!-- =====================================================
             OVERVIEW SECTION - Fillimi
             ===================================================== -->
        <section class="dashboard-section active" id="overviewSection">
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-card-header">
                        <div class="stat-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
                            </svg>
                        </div>
                        <span class="stat-badge good" id="bmiBadge">Normal</span>
                    </div>
                    <div class="stat-value" id="statBMI">--</div>
                    <div class="stat-label">BMI</div>
                </div>

                <div class="stat-card blue">
                    <div class="stat-card-header">
                        <div class="stat-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="stat-value" id="statHeight">-- cm</div>
                    <div class="stat-label">Gjatesia</div>
                </div>

                <div class="stat-card cyan">
                    <div class="stat-card-header">
                        <div class="stat-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"/>
                                <path d="M12 6v6l4 2"/>
                            </svg>
                        </div>
                    </div>
                    <div class="stat-value" id="statWeight">-- kg</div>
                    <div class="stat-label">Pesha</div>
                </div>

                <div class="stat-card purple">
                    <div class="stat-card-header">
                        <div class="stat-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                <circle cx="12" cy="7" r="4"/>
                            </svg>
                        </div>
                    </div>
                    <div class="stat-value" id="statAge">-- vjec</div>
                    <div class="stat-label">Mosha</div>
                </div>
            </div>

            <div class="content-grid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Te dhenat e tua</h3>
                    </div>
                    <div class="data-grid">
                        <div class="data-item">
                            <div class="data-item-label">Email</div>
                            <div class="data-item-value" id="dataEmail">--</div>
                        </div>
                        <div class="data-item">
                            <div class="data-item-label">Gjinia</div>
                            <div class="data-item-value" id="dataGender">--</div>
                        </div>
                        <div class="data-item">
                            <div class="data-item-label">Gjatesia</div>
                            <div class="data-item-value" id="dataHeight">--</div>
                        </div>
                        <div class="data-item">
                            <div class="data-item-label">Pesha</div>
                            <div class="data-item-value" id="dataWeight">--</div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="health-status">
                        <div class="health-meter">
                            <svg width="160" height="160">
                                <circle class="bg" cx="80" cy="80" r="65"/>
                                <circle class="progress" id="healthProgress" cx="80" cy="80" r="65" 
                                        stroke-dasharray="408.4" stroke-dashoffset="408.4"/>
                            </svg>
                            <div class="health-meter-value">
                                <div class="value" id="healthBMI">--</div>
                                <div class="label">BMI</div>
                            </div>
                        </div>
                        <div class="health-status-text" id="healthStatusText">Duke llogaritur...</div>
                        <div class="health-status-desc" id="healthStatusDesc">Statusi i shendetit bazuar ne BMI</div>
                    </div>
                </div>
            </div>
        </section>
        <!-- =====================================================
             OVERVIEW SECTION - Fundi
             ===================================================== -->

        <!-- =====================================================
             NUTRITION SECTION - Fillimi
             ===================================================== -->
        <section class="dashboard-section" id="nutritionSection">
            <div class="daily-calories">
                <div class="daily-calories-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 20V10"/>
                        <path d="M18 20V4"/>
                        <path d="M6 20v-4"/>
                    </svg>
                </div>
                <div class="daily-calories-info">
                    <h3 id="totalCalories">0 kcal</h3>
                    <p>Kalorite e sotme</p>
                </div>
            </div>

            <div class="calories-progress">
                <div class="calories-progress-bar">
                    <div class="calories-progress-fill" id="caloriesProgressFill" style="width: 0%"></div>
                </div>
                <div class="calories-progress-text">
                    <span id="caloriesConsumed">0 kcal konsumuar</span>
                    <span id="caloriesGoal">Objektivi: 2000 kcal</span>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Kategorite e Ushqimit</h3>
                </div>
                <div class="food-categories">
                    <div class="food-category active" onclick="filterFood('all')">
                        <div class="food-category-icon">🍽️</div>
                        <div class="food-category-name">Te gjitha</div>
                    </div>
                    <div class="food-category" onclick="filterFood('fruits')">
                        <div class="food-category-icon">🍎</div>
                        <div class="food-category-name">Frutat</div>
                    </div>
                    <div class="food-category" onclick="filterFood('vegetables')">
                        <div class="food-category-icon">🥬</div>
                        <div class="food-category-name">Perimet</div>
                    </div>
                    <div class="food-category" onclick="filterFood('proteins')">
                        <div class="food-category-icon">🥩</div>
                        <div class="food-category-name">Proteina</div>
                    </div>
                    <div class="food-category" onclick="filterFood('dairy')">
                        <div class="food-category-icon">🧀</div>
                        <div class="food-category-name">Bulmet</div>
                    </div>
                    <div class="food-category" onclick="filterFood('grains')">
                        <div class="food-category-icon">🍞</div>
                        <div class="food-category-name">Drithera</div>
                    </div>
                    <div class="food-category" onclick="filterFood('drinks')">
                        <div class="food-category-icon">🥤</div>
                        <div class="food-category-name">Pijet</div>
                    </div>
                    <div class="food-category" onclick="filterFood('desserts')">
                        <div class="food-category-icon">🍰</div>
                        <div class="food-category-name">Embelsira</div>
                    </div>
                </div>
            </div>

            <div class="card" style="margin-top: 1.5rem;">
                <div class="card-header">
                    <h3 class="card-title">Ushqimet e Disponueshme</h3>
                </div>
                <div class="food-list" id="foodList"></div>
                <div class="add-food-btn" onclick="openAddFoodModal()">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="12" y1="5" x2="12" y2="19"/>
                        <line x1="5" y1="12" x2="19" y2="12"/>
                    </svg>
                    Shto ushqim te ri
                </div>
            </div>

            <div class="card" style="margin-top: 1.5rem;">
                <div class="card-header">
                    <h3 class="card-title">Ushqimet e Shtuara Sot</h3>
                </div>
                <div class="food-list" id="addedFoodList">
                    <p style="text-align: center; color: var(--text-muted); padding: 2rem;">
                        Nuk ke shtuar asnje ushqim sot. Kliko butonin + per te shtuar.
                    </p>
                </div>
            </div>
        </section>
        <!-- =====================================================
             NUTRITION SECTION - Fundi
             ===================================================== -->

        <!-- =====================================================
             PROFILE SECTION - Fillimi
             ===================================================== -->
        <section class="dashboard-section" id="profileSection">
            <div class="profile-header">
                <div class="profile-avatar-large" id="profileAvatar" onclick="openAvatarModal()">
                    <span id="profileAvatarText">U</span>
                    <div class="profile-avatar-edit">Ndrysho</div>
                </div>
                <div class="profile-info">
                    <h2 id="profileName">Perdoruesi</h2>
                    <p class="email" id="profileEmail">email@example.com</p>
                    <div class="profile-badges">
                        <span class="profile-badge" id="profileGenderBadge">Gjinia</span>
                        <span class="profile-badge" id="profileAgeBadge">Mosha</span>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Cilesimet e Profilit</h3>
                </div>
                <form onsubmit="updateProfile(event)">
                    <div class="profile-form-grid">
                        <div class="profile-form-group">
                            <label class="profile-form-label" for="profileEmailInput">Email</label>
                            <input type="email" id="profileEmailInput" class="profile-form-input" disabled>
                        </div>
                        <div class="profile-form-group">
                            <label class="profile-form-label" for="profileGenderInput">Gjinia</label>
                            <input type="text" id="profileGenderInput" class="profile-form-input" disabled>
                        </div>
                        <div class="profile-form-group">
                            <label class="profile-form-label" for="profileHeightInput">Gjatesia (cm)</label>
                            <input type="number" id="profileHeightInput" class="profile-form-input" min="120" max="230">
                        </div>
                        <div class="profile-form-group">
                            <label class="profile-form-label" for="profileWeightInput">Pesha (kg)</label>
                            <input type="number" id="profileWeightInput" class="profile-form-input" min="30" max="250">
                        </div>
                        <div class="profile-form-group">
                            <label class="profile-form-label" for="profileAgeInput">Mosha</label>
                            <input type="number" id="profileAgeInput" class="profile-form-input" min="10" max="100">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" style="margin-top: 1.5rem; max-width: 200px;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                            <polyline points="17 21 17 13 7 13 7 21"/>
                            <polyline points="7 3 7 8 15 8"/>
                        </svg>
                        Ruaj Ndryshimet
                    </button>
                </form>
            </div>
        </section>
        <!-- =====================================================
             PROFILE SECTION - Fundi
             ===================================================== -->
    </main>
    <!-- =====================================================
         MAIN CONTENT - Fundi
         ===================================================== -->

    <!-- =====================================================
         MODALS - Fillimi
         ===================================================== -->
    
    <!-- Add Food Modal -->
    <div class="modal-overlay" id="addFoodModal">
        <div class="modal">
            <div class="modal-header">
                <h3 class="modal-title">Shto Ushqim te Ri</h3>
                <button class="modal-close" onclick="closeAddFoodModal()">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"/>
                        <line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                </button>
            </div>
            <form onsubmit="addCustomFood(event)">
                <div class="form-group">
                    <label class="form-label" for="foodName">Emri i Ushqimit</label>
                    <input type="text" id="foodName" class="form-input" placeholder="p.sh. Molle" required>
                </div>
                <div class="input-row">
                    <div class="form-group">
                        <label class="form-label" for="foodCalories">Kalorite</label>
                        <input type="number" id="foodCalories" class="form-input" placeholder="100" min="0" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="foodCategory">Kategoria</label>
                        <select id="foodCategory" class="form-input" required>
                            <option value="fruits">Frutat</option>
                            <option value="vegetables">Perimet</option>
                            <option value="proteins">Proteina</option>
                            <option value="dairy">Bulmet</option>
                            <option value="grains">Drithera</option>
                            <option value="drinks">Pijet</option>
                            <option value="desserts">Embelsira</option>
                        </select>
                    </div>
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeAddFoodModal()">Anulo</button>
                    <button type="submit" class="btn btn-primary">Shto</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Avatar Upload Modal -->
    <div class="modal-overlay" id="avatarModal">
        <div class="modal">
            <div class="modal-header">
                <h3 class="modal-title">Ndrysho Foton e Profilit</h3>
                <button class="modal-close" onclick="closeAvatarModal()">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"/>
                        <line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                </button>
            </div>
            <div style="text-align: center;">
                <div class="profile-avatar-large" style="margin: 0 auto 1.5rem; width: 150px; height: 150px; cursor: default;">
                    <span id="avatarPreviewText">U</span>
                    <img id="avatarPreviewImg" style="display: none;" alt="Avatar Preview">
                </div>
                <input type="file" id="avatarInput" accept="image/*" onchange="previewAvatar(event)" style="display: none;">
                <label for="avatarInput" class="btn btn-secondary" style="cursor: pointer; margin-bottom: 1rem; display: inline-flex;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                        <polyline points="17 8 12 3 7 8"/>
                        <line x1="12" y1="3" x2="12" y2="15"/>
                    </svg>
                    Zgjidh Foto
                </label>
            </div>
            <div class="modal-actions">
                <button type="button" class="btn btn-secondary" onclick="closeAvatarModal()">Anulo</button>
                <button type="button" class="btn btn-primary" onclick="saveAvatar()">Ruaj</button>
            </div>
        </div>
    </div>
    <!-- =====================================================
         MODALS - Fundi
         ===================================================== -->

    <!-- =====================================================
         JAVASCRIPT - Fillimi
         ===================================================== -->
    <script>
        // =====================================================
        // CHECK SESSION - Kontrollo nese perdoruesi eshte i loguar
        // =====================================================
        function checkSession() {
            const userData = localStorage.getItem('bittracker_user');
            if (!userData) {
                // Redirect to login if not logged in
                window.location.href = 'index.php';
                return false;
            }
            return true;
        }

        // Initialize - Check session first
        if (checkSession()) {
            loadDashboardData();
            updateDate();
            loadFoods();
            loadDailyFoods();
        }

        // =====================================================
        // LOAD DASHBOARD DATA - Ngarko te dhenat e dashboard
        // =====================================================
        function loadDashboardData() {
            const userData = JSON.parse(localStorage.getItem('bittracker_user'));
            if (!userData) return;

            // Calculate BMI
            const bmi = (userData.weight / Math.pow(userData.height / 100, 2)).toFixed(1);

            // Update stats
            document.getElementById('statBMI').textContent = bmi;
            document.getElementById('statHeight').textContent = userData.height + ' cm';
            document.getElementById('statWeight').textContent = userData.weight + ' kg';
            document.getElementById('statAge').textContent = userData.age + ' vjec';

            // Update BMI badge
            const bmiBadge = document.getElementById('bmiBadge');
            if (bmi < 18.5) {
                bmiBadge.textContent = 'Nen peshe';
                bmiBadge.className = 'stat-badge warning';
            } else if (bmi < 25) {
                bmiBadge.textContent = 'Normal';
                bmiBadge.className = 'stat-badge good';
            } else if (bmi < 30) {
                bmiBadge.textContent = 'Mbipeshe';
                bmiBadge.className = 'stat-badge warning';
            } else {
                bmiBadge.textContent = 'Obezitet';
                bmiBadge.className = 'stat-badge danger';
            }

            // Update data display
            document.getElementById('dataEmail').textContent = userData.email;
            document.getElementById('dataGender').textContent = userData.gender === 'mashkull' ? 'Mashkull' : 'Femer';
            document.getElementById('dataHeight').textContent = userData.height + ' cm';
            document.getElementById('dataWeight').textContent = userData.weight + ' kg';

            // Update health meter
            updateHealthMeter(bmi);

            // Update sidebar user
            const initials = userData.email.charAt(0).toUpperCase();
            document.getElementById('sidebarAvatarText').textContent = initials;
            document.getElementById('sidebarUserName').textContent = userData.email.split('@')[0];
            document.getElementById('sidebarUserEmail').textContent = userData.email;

            // Update profile
            document.getElementById('profileAvatarText').textContent = initials;
            document.getElementById('profileName').textContent = userData.email.split('@')[0];
            document.getElementById('profileEmail').textContent = userData.email;
            document.getElementById('profileGenderBadge').textContent = userData.gender === 'mashkull' ? 'Mashkull' : 'Femer';
            document.getElementById('profileAgeBadge').textContent = userData.age + ' vjec';

            // Update profile form
            document.getElementById('profileEmailInput').value = userData.email;
            document.getElementById('profileGenderInput').value = userData.gender === 'mashkull' ? 'Mashkull' : 'Femer';
            document.getElementById('profileHeightInput').value = userData.height;
            document.getElementById('profileWeightInput').value = userData.weight;
            document.getElementById('profileAgeInput').value = userData.age;

            // Load avatar if exists
            if (userData.avatar) {
                loadAvatarImage(userData.avatar);
            }

            // Update greeting
            const hour = new Date().getHours();
            let greeting = 'Mirembremba';
            if (hour < 12) greeting = 'Miremengjes';
            else if (hour < 18) greeting = 'Miredita';
            document.getElementById('dashboardGreeting').textContent = greeting + ', ' + userData.email.split('@')[0] + '!';
        }

        function loadAvatarImage(src) {
            // Sidebar avatar
            const sidebarAvatar = document.getElementById('sidebarAvatar');
            const sidebarText = document.getElementById('sidebarAvatarText');
            sidebarText.style.display = 'none';
            let img = sidebarAvatar.querySelector('img');
            if (!img) {
                img = document.createElement('img');
                sidebarAvatar.appendChild(img);
            }
            img.src = src;

            // Profile avatar
            const profileAvatar = document.getElementById('profileAvatar');
            const profileText = document.getElementById('profileAvatarText');
            profileText.style.display = 'none';
            let profImg = profileAvatar.querySelector('img');
            if (!profImg) {
                profImg = document.createElement('img');
                profImg.style.position = 'absolute';
                profImg.style.top = '0';
                profImg.style.left = '0';
                profileAvatar.appendChild(profImg);
            }
            profImg.src = src;
        }

        // =====================================================
        // HEALTH METER UPDATE - Perditeso meterin e shendetit
        // =====================================================
        function updateHealthMeter(bmi) {
            const progress = document.getElementById('healthProgress');
            const healthBMI = document.getElementById('healthBMI');
            const statusText = document.getElementById('healthStatusText');
            const statusDesc = document.getElementById('healthStatusDesc');

            healthBMI.textContent = bmi;

            // Calculate progress (BMI 15-40 range)
            let percentage = ((bmi - 15) / 25) * 100;
            percentage = Math.min(Math.max(percentage, 0), 100);

            const circumference = 2 * Math.PI * 65;
            const offset = circumference - (percentage / 100) * circumference;
            progress.style.strokeDashoffset = offset;

            // Determine status
            let status, desc, color;
            if (bmi < 18.5) {
                status = 'Nen peshe';
                desc = 'Konsidero te rrisesh masen trupore';
                color = '#3b82f6';
            } else if (bmi < 25) {
                status = 'Peshe normale';
                desc = 'Vazhdo keshtu! Je ne forme te shkelqyer';
                color = '#10b981';
            } else if (bmi < 30) {
                status = 'Mbipeshe';
                desc = 'Konsidero me shume aktivitet fizik';
                color = '#f59e0b';
            } else {
                status = 'Obezitet';
                desc = 'Keshillohesh te konsultohesh me mjekun';
                color = '#ef4444';
            }

            statusText.textContent = status;
            statusText.style.color = color;
            statusDesc.textContent = desc;
            progress.style.stroke = color;
        }

        // =====================================================
        // DATE UPDATE - Perditeso daten
        // =====================================================
        function updateDate() {
            const now = new Date();
            const albanianDays = ['E Diel', 'E Hene', 'E Marte', 'E Merkure', 'E Enjte', 'E Premte', 'E Shtune'];
            const albanianMonths = ['Janar', 'Shkurt', 'Mars', 'Prill', 'Maj', 'Qershor', 'Korrik', 'Gusht', 'Shtator', 'Tetor', 'Nentor', 'Dhjetor'];
            
            document.getElementById('dashboardDate').textContent = 
                `${albanianDays[now.getDay()]}, ${now.getDate()} ${albanianMonths[now.getMonth()]} ${now.getFullYear()}`;
        }

        // =====================================================
        // SECTION SWITCHING - Ndryshimi i seksioneve
        // =====================================================
        function switchSection(section) {
            document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
            document.querySelectorAll('.dashboard-section').forEach(s => s.classList.remove('active'));

            event.currentTarget.classList.add('active');
            document.getElementById(section + 'Section').classList.add('active');

            // Close mobile sidebar
            document.getElementById('sidebar').classList.remove('open');
        }

        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
        }

        // =====================================================
        // FOOD DATABASE - Te gjitha ushqimet shqip
        // =====================================================
        const foodDatabase = [
            // Frutat
            { id: 1, name: 'Molle', calories: 52, category: 'fruits', icon: '🍎', portion: '100g' },
            { id: 2, name: 'Banane', calories: 89, category: 'fruits', icon: '🍌', portion: '100g' },
            { id: 3, name: 'Portokall', calories: 47, category: 'fruits', icon: '🍊', portion: '100g' },
            { id: 4, name: 'Rrush', calories: 69, category: 'fruits', icon: '🍇', portion: '100g' },
            { id: 5, name: 'Lulebore', calories: 30, category: 'fruits', icon: '🍓', portion: '100g' },
            { id: 6, name: 'Kumbull', calories: 46, category: 'fruits', icon: '🫐', portion: '100g' },
            { id: 7, name: 'Pjeshke', calories: 39, category: 'fruits', icon: '🍑', portion: '100g' },
            { id: 8, name: 'Shalqi', calories: 30, category: 'fruits', icon: '🍉', portion: '100g' },
            { id: 9, name: 'Qershi', calories: 50, category: 'fruits', icon: '🍒', portion: '100g' },
            { id: 10, name: 'Dardhe', calories: 57, category: 'fruits', icon: '🍐', portion: '100g' },
            
            // Perimet
            { id: 11, name: 'Domate', calories: 18, category: 'vegetables', icon: '🍅', portion: '100g' },
            { id: 12, name: 'Kastravec', calories: 15, category: 'vegetables', icon: '🥒', portion: '100g' },
            { id: 13, name: 'Karrote', calories: 41, category: 'vegetables', icon: '🥕', portion: '100g' },
            { id: 14, name: 'Brokoli', calories: 34, category: 'vegetables', icon: '🥦', portion: '100g' },
            { id: 15, name: 'Spinaq', calories: 23, category: 'vegetables', icon: '🥬', portion: '100g' },
            { id: 16, name: 'Laker', calories: 25, category: 'vegetables', icon: '🥬', portion: '100g' },
            { id: 17, name: 'Qepe', calories: 40, category: 'vegetables', icon: '🧅', portion: '100g' },
            { id: 18, name: 'Hudher', calories: 149, category: 'vegetables', icon: '🧄', portion: '100g' },
            { id: 19, name: 'Spec', calories: 31, category: 'vegetables', icon: '🫑', portion: '100g' },
            { id: 20, name: 'Patellxhan', calories: 25, category: 'vegetables', icon: '🍆', portion: '100g' },
            { id: 21, name: 'Patate', calories: 77, category: 'vegetables', icon: '🥔', portion: '100g' },
            { id: 22, name: 'Kungull', calories: 26, category: 'vegetables', icon: '🎃', portion: '100g' },
            
            // Proteina
            { id: 23, name: 'Mish Pule', calories: 165, category: 'proteins', icon: '🍗', portion: '100g' },
            { id: 24, name: 'Mish Vici', calories: 250, category: 'proteins', icon: '🥩', portion: '100g' },
            { id: 25, name: 'Peshk', calories: 206, category: 'proteins', icon: '🐟', portion: '100g' },
            { id: 26, name: 'Veze', calories: 155, category: 'proteins', icon: '🥚', portion: '100g' },
            { id: 27, name: 'Mish Derri', calories: 242, category: 'proteins', icon: '🥓', portion: '100g' },
            { id: 28, name: 'Mish Qengji', calories: 294, category: 'proteins', icon: '🍖', portion: '100g' },
            { id: 29, name: 'Karkalec', calories: 99, category: 'proteins', icon: '🦐', portion: '100g' },
            { id: 30, name: 'Tuna', calories: 132, category: 'proteins', icon: '🐟', portion: '100g' },
            
            // Bulmet
            { id: 31, name: 'Qumesht', calories: 42, category: 'dairy', icon: '🥛', portion: '100ml' },
            { id: 32, name: 'Djathe', calories: 402, category: 'dairy', icon: '🧀', portion: '100g' },
            { id: 33, name: 'Kos', calories: 59, category: 'dairy', icon: '🥛', portion: '100g' },
            { id: 34, name: 'Gjize', calories: 98, category: 'dairy', icon: '🧀', portion: '100g' },
            { id: 35, name: 'Ajke', calories: 717, category: 'dairy', icon: '🧈', portion: '100g' },
            
            // Drithera
            { id: 36, name: 'Buke', calories: 265, category: 'grains', icon: '🍞', portion: '100g' },
            { id: 37, name: 'Oriz', calories: 130, category: 'grains', icon: '🍚', portion: '100g' },
            { id: 38, name: 'Makarona', calories: 131, category: 'grains', icon: '🍝', portion: '100g' },
            { id: 39, name: 'Tershere', calories: 389, category: 'grains', icon: '🥣', portion: '100g' },
            { id: 40, name: 'Byrek', calories: 290, category: 'grains', icon: '🥧', portion: '100g' },
            
            // Pijet
            { id: 41, name: 'Uje', calories: 0, category: 'drinks', icon: '💧', portion: '250ml' },
            { id: 42, name: 'Caj', calories: 1, category: 'drinks', icon: '🍵', portion: '250ml' },
            { id: 43, name: 'Kafe', calories: 2, category: 'drinks', icon: '☕', portion: '250ml' },
            { id: 44, name: 'Leng Portokalli', calories: 45, category: 'drinks', icon: '🧃', portion: '250ml' },
            { id: 45, name: 'Leng Molle', calories: 46, category: 'drinks', icon: '🧃', portion: '250ml' },
            
            // Embelsira
            { id: 46, name: 'Bakllave', calories: 334, category: 'desserts', icon: '🥮', portion: '100g' },
            { id: 47, name: 'Akullore', calories: 207, category: 'desserts', icon: '🍦', portion: '100g' },
            { id: 48, name: 'Torte', calories: 257, category: 'desserts', icon: '🍰', portion: '100g' },
            { id: 49, name: 'Cokollate', calories: 546, category: 'desserts', icon: '🍫', portion: '100g' },
            { id: 50, name: 'Trileqe', calories: 300, category: 'desserts', icon: '🍮', portion: '100g' }
        ];

        let currentFilter = 'all';

        // =====================================================
        // LOAD FOODS - Ngarko ushqimet
        // =====================================================
        function loadFoods() {
            const foodList = document.getElementById('foodList');
            let filteredFoods = foodDatabase;

            if (currentFilter !== 'all') {
                filteredFoods = foodDatabase.filter(f => f.category === currentFilter);
            }

            foodList.innerHTML = filteredFoods.map(food => `
                <div class="food-item">
                    <div class="food-item-info">
                        <div class="food-item-icon">${food.icon}</div>
                        <div>
                            <div class="food-item-name">${food.name}</div>
                            <div class="food-item-details">${food.portion}</div>
                        </div>
                    </div>
                    <div class="food-item-actions">
                        <div class="food-item-calories">${food.calories} kcal</div>
                        <button class="food-item-btn" onclick="addFoodToDaily(${food.id})">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="12" y1="5" x2="12" y2="19"/>
                                <line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                        </button>
                    </div>
                </div>
            `).join('');
        }

        // =====================================================
        // FILTER FOOD - Filtro ushqimet
        // =====================================================
        function filterFood(category) {
            currentFilter = category;
            document.querySelectorAll('.food-category').forEach(c => c.classList.remove('active'));
            event.currentTarget.classList.add('active');
            loadFoods();
        }

        // =====================================================
        // ADD FOOD TO DAILY - Shto ushqim ne listen ditore
        // =====================================================
        function addFoodToDaily(foodId) {
            const food = foodDatabase.find(f => f.id === foodId);
            if (!food) return;

            let dailyFoods = JSON.parse(localStorage.getItem('bittracker_daily_foods') || '[]');
            dailyFoods.push({
                ...food,
                addedAt: new Date().toISOString()
            });
            localStorage.setItem('bittracker_daily_foods', JSON.stringify(dailyFoods));

            loadDailyFoods();
            showToast('Ushqimi u shtua me sukses!');
        }

        // =====================================================
        // LOAD DAILY FOODS - Ngarko ushqimet ditore
        // =====================================================
        function loadDailyFoods() {
            const addedFoodList = document.getElementById('addedFoodList');
            const dailyFoods = JSON.parse(localStorage.getItem('bittracker_daily_foods') || '[]');

            if (dailyFoods.length === 0) {
                addedFoodList.innerHTML = `
                    <p style="text-align: center; color: var(--text-muted); padding: 2rem;">
                        Nuk ke shtuar asnje ushqim sot. Kliko butonin + per te shtuar.
                    </p>
                `;
                updateCaloriesProgress(0);
                return;
            }

            const totalCalories = dailyFoods.reduce((sum, f) => sum + f.calories, 0);
            updateCaloriesProgress(totalCalories);

            addedFoodList.innerHTML = dailyFoods.map((food, index) => `
                <div class="food-item">
                    <div class="food-item-info">
                        <div class="food-item-icon">${food.icon}</div>
                        <div>
                            <div class="food-item-name">${food.name}</div>
                            <div class="food-item-details">${food.portion}</div>
                        </div>
                    </div>
                    <div class="food-item-actions">
                        <div class="food-item-calories">${food.calories} kcal</div>
                        <button class="food-item-btn delete" onclick="removeDailyFood(${index})">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="3 6 5 6 21 6"/>
                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                            </svg>
                        </button>
                    </div>
                </div>
            `).join('');
        }

        // =====================================================
        // UPDATE CALORIES PROGRESS - Perditeso progresin e kalorive
        // =====================================================
        function updateCaloriesProgress(total) {
            const goal = 2000;
            const percentage = Math.min((total / goal) * 100, 100);

            document.getElementById('totalCalories').textContent = total + ' kcal';
            document.getElementById('caloriesProgressFill').style.width = percentage + '%';
            document.getElementById('caloriesConsumed').textContent = total + ' kcal konsumuar';
        }

        // =====================================================
        // REMOVE DAILY FOOD - Hiq ushqimin ditor
        // =====================================================
        function removeDailyFood(index) {
            let dailyFoods = JSON.parse(localStorage.getItem('bittracker_daily_foods') || '[]');
            dailyFoods.splice(index, 1);
            localStorage.setItem('bittracker_daily_foods', JSON.stringify(dailyFoods));
            loadDailyFoods();
            showToast('Ushqimi u hoq!');
        }

        // =====================================================
        // ADD FOOD MODAL - Modal per shtim ushqimi
        // =====================================================
        function openAddFoodModal() {
            document.getElementById('addFoodModal').classList.add('active');
        }

        function closeAddFoodModal() {
            document.getElementById('addFoodModal').classList.remove('active');
            document.getElementById('foodName').value = '';
            document.getElementById('foodCalories').value = '';
        }

        function addCustomFood(e) {
            e.preventDefault();
            const name = document.getElementById('foodName').value;
            const calories = parseInt(document.getElementById('foodCalories').value);
            const category = document.getElementById('foodCategory').value;

            const icons = {
                fruits: '🍎', vegetables: '🥬', proteins: '🥩',
                dairy: '🧀', grains: '🍞', drinks: '🥤', desserts: '🍰'
            };

            const newFood = {
                id: Date.now(),
                name: name,
                calories: calories,
                category: category,
                icon: icons[category],
                portion: '100g'
            };

            foodDatabase.push(newFood);
            loadFoods();
            closeAddFoodModal();
            showToast('Ushqimi i ri u shtua!');
        }

        // =====================================================
        // PROFILE UPDATE - Perditeso profilin
        // =====================================================
        function updateProfile(e) {
            e.preventDefault();

            const height = parseInt(document.getElementById('profileHeightInput').value);
            const weight = parseInt(document.getElementById('profileWeightInput').value);
            const age = parseInt(document.getElementById('profileAgeInput').value);

            // Validation
            if (height < 120 || height > 230) {
                showToast('Gjatesia duhet te jete mes 120 dhe 230 cm');
                return;
            }
            if (weight < 30 || weight > 250) {
                showToast('Pesha duhet te jete mes 30 dhe 250 kg');
                return;
            }
            if (age < 10 || age > 100) {
                showToast('Mosha duhet te jete mes 10 dhe 100 vjec');
                return;
            }

            // Update localStorage
            const userData = JSON.parse(localStorage.getItem('bittracker_user'));
            userData.height = height;
            userData.weight = weight;
            userData.age = age;
            localStorage.setItem('bittracker_user', JSON.stringify(userData));

            // Reload dashboard
            loadDashboardData();
            showToast('Profili u perditesua me sukses!');
        }

        // =====================================================
        // AVATAR MODAL - Modal per foton e profilit
        // =====================================================
        let tempAvatarData = null;

        function openAvatarModal() {
            document.getElementById('avatarModal').classList.add('active');
            const userData = JSON.parse(localStorage.getItem('bittracker_user'));
            const initials = userData.email.charAt(0).toUpperCase();
            
            if (userData.avatar) {
                document.getElementById('avatarPreviewImg').src = userData.avatar;
                document.getElementById('avatarPreviewImg').style.display = 'block';
                document.getElementById('avatarPreviewText').style.display = 'none';
            } else {
                document.getElementById('avatarPreviewText').textContent = initials;
                document.getElementById('avatarPreviewText').style.display = 'block';
                document.getElementById('avatarPreviewImg').style.display = 'none';
            }
        }

        function closeAvatarModal() {
            document.getElementById('avatarModal').classList.remove('active');
            tempAvatarData = null;
        }

        function previewAvatar(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    tempAvatarData = event.target.result;
                    document.getElementById('avatarPreviewImg').src = tempAvatarData;
                    document.getElementById('avatarPreviewImg').style.display = 'block';
                    document.getElementById('avatarPreviewText').style.display = 'none';
                };
                reader.readAsDataURL(file);
            }
        }

        function saveAvatar() {
            if (tempAvatarData) {
                const userData = JSON.parse(localStorage.getItem('bittracker_user'));
                userData.avatar = tempAvatarData;
                localStorage.setItem('bittracker_user', JSON.stringify(userData));
                loadDashboardData();
                showToast('Fotoja u ruajt!');
            }
            closeAvatarModal();
        }

        // =====================================================
        // LOGOUT - Dil nga llogaria
        // =====================================================
        function handleLogout() {
            localStorage.removeItem('bittracker_user');
            localStorage.removeItem('bittracker_daily_foods');
            window.location.href = 'index.php';
        }

        // =====================================================
        // TOAST NOTIFICATION - Njoftim
        // =====================================================
        function showToast(message) {
            const existingToast = document.querySelector('.toast');
            if (existingToast) {
                existingToast.remove();
            }

            const toast = document.createElement('div');
            toast.className = 'toast success';
            toast.textContent = message;
            document.body.appendChild(toast);

            setTimeout(() => {
                toast.remove();
            }, 3000);
        }
    </script>
    <!-- =====================================================
         JAVASCRIPT - Fundi
         ===================================================== -->
</body>
</html>
<!-- =====================================================
     DASHBOARD.PHP - FUNDI I FILE-IT
     ===================================================== -->
