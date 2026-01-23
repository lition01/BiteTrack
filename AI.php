<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitLife Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --bg-primary: #f8faf9;
            --bg-secondary: #ffffff;
            --bg-sidebar: #ffffff;
            --text-primary: #1a2e1a;
            --text-secondary: #5a6b5a;
            --text-muted: #8a9a8a;
            --accent: #4a9d7c;
            --accent-light: #e8f5f0;
            --accent-hover: #3d8a6c;
            --border: #e5ebe5;
            --shadow: rgba(0, 0, 0, 0.05);
            --shadow-lg: rgba(0, 0, 0, 0.1);
            --card-bg: #ffffff;
            --success: #22c55e;
            --warning: #f59e0b;
            --info: #3b82f6;
            --danger: #ef4444;
        }

        [data-theme="dark"] {
            --bg-primary: #0f1610;
            --bg-secondary: #1a231a;
            --bg-sidebar: #141c14;
            --text-primary: #e8f0e8;
            --text-secondary: #a8b8a8;
            --text-muted: #6a7a6a;
            --accent: #5ab88c;
            --accent-light: #1a2e22;
            --accent-hover: #6cc89c;
            --border: #2a3a2a;
            --shadow: rgba(0, 0, 0, 0.3);
            --shadow-lg: rgba(0, 0, 0, 0.4);
            --card-bg: #1a231a;
        }

        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background-color: var(--bg-primary);
            color: var(--text-primary);
            min-height: 100vh;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .dashboard {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            background: var(--bg-sidebar);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            z-index: 100;
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        .sidebar-header {
            padding: 24px;
            border-bottom: 1px solid var(--border);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--accent), var(--accent-hover));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-icon svg {
            width: 24px;
            height: 24px;
            fill: white;
        }

        .logo-text {
            font-size: 22px;
            font-weight: 700;
            color: var(--text-primary);
        }

        .sidebar-nav {
            flex: 1;
            padding: 16px 12px;
            overflow-y: auto;
        }

        .nav-section {
            margin-bottom: 24px;
        }

        .nav-section-title {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--text-muted);
            padding: 0 12px;
            margin-bottom: 8px;
        }

        .nav-btn {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border: none;
            background: transparent;
            border-radius: 10px;
            cursor: pointer;
            color: var(--text-secondary);
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s ease;
            text-align: left;
        }

        .nav-btn:hover {
            background: var(--accent-light);
            color: var(--accent);
        }

        .nav-btn.active {
            background: var(--accent-light);
            color: var(--accent);
        }

        .nav-btn svg {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
        }

        .sidebar-footer {
            padding: 16px;
            border-top: 1px solid var(--border);
        }

        .user-card {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            background: var(--bg-primary);
            border-radius: 12px;
            margin-bottom: 12px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            object-fit: cover;
            background: var(--accent-light);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: var(--accent);
        }

        .user-info {
            flex: 1;
            min-width: 0;
        }

        .user-name {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-primary);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-email {
            font-size: 12px;
            color: var(--text-muted);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .theme-toggle {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px;
            background: var(--bg-primary);
            border-radius: 10px;
        }

        .theme-toggle-label {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            color: var(--text-secondary);
        }

        .theme-toggle-label svg {
            width: 18px;
            height: 18px;
        }

        .toggle-switch {
            position: relative;
            width: 44px;
            height: 24px;
            background: var(--border);
            border-radius: 12px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .toggle-switch.active {
            background: var(--accent);
        }

        .toggle-switch::after {
            content: '';
            position: absolute;
            top: 3px;
            left: 3px;
            width: 18px;
            height: 18px;
            background: white;
            border-radius: 50%;
            transition: transform 0.3s ease;
        }

        .toggle-switch.active::after {
            transform: translateX(20px);
        }

        /* Main Content */
        .main-wrapper {
            flex: 1;
            margin-left: 260px;
            display: flex;
            flex-direction: column;
            transition: margin-left 0.3s ease;
        }

        /* Header */
        .header {
            background: var(--bg-secondary);
            border-bottom: 1px solid var(--border);
            padding: 20px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .header-left {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .header-date {
            font-size: 13px;
            color: var(--text-muted);
        }

        .header-greeting {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-primary);
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .quick-stat {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 16px;
            background: var(--bg-primary);
            border-radius: 10px;
        }

        .quick-stat-icon {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .quick-stat-icon.calories {
            background: #fef3c7;
            color: #f59e0b;
        }

        .quick-stat-icon.steps {
            background: #dbeafe;
            color: #3b82f6;
        }

        .quick-stat-icon.water {
            background: #e0f2fe;
            color: #0ea5e9;
        }

        .quick-stat-icon svg {
            width: 18px;
            height: 18px;
        }

        .quick-stat-info {
            display: flex;
            flex-direction: column;
        }

        .quick-stat-value {
            font-size: 16px;
            font-weight: 700;
            color: var(--text-primary);
        }

        .quick-stat-label {
            font-size: 12px;
            color: var(--text-muted);
        }

        .menu-toggle {
            display: none;
            width: 40px;
            height: 40px;
            border: none;
            background: var(--bg-primary);
            border-radius: 10px;
            cursor: pointer;
            align-items: center;
            justify-content: center;
        }

        .menu-toggle svg {
            width: 24px;
            height: 24px;
            color: var(--text-primary);
        }

        /* Content Area */
        .content {
            flex: 1;
            padding: 32px;
        }

        .section {
            display: none;
            animation: fadeIn 0.3s ease;
        }

        .section.active {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .section-header {
            margin-bottom: 24px;
        }

        .section-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 4px;
        }

        .section-subtitle {
            font-size: 14px;
            color: var(--text-muted);
        }

        /* Cards Grid */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 24px;
        }

        .card {
            background: var(--card-bg);
            border-radius: 16px;
            padding: 24px;
            border: 1px solid var(--border);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px var(--shadow);
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .card-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card-icon.green {
            background: var(--accent-light);
            color: var(--accent);
        }

        .card-icon.blue {
            background: #dbeafe;
            color: #3b82f6;
        }

        .card-icon.orange {
            background: #fef3c7;
            color: #f59e0b;
        }

        .card-icon.red {
            background: #fee2e2;
            color: #ef4444;
        }

        .card-icon.purple {
            background: #f3e8ff;
            color: #a855f7;
        }

        .card-icon svg {
            width: 24px;
            height: 24px;
        }

        .card-badge {
            font-size: 12px;
            padding: 4px 10px;
            border-radius: 20px;
            font-weight: 500;
        }

        .card-badge.up {
            background: #dcfce7;
            color: #16a34a;
        }

        .card-badge.down {
            background: #fee2e2;
            color: #dc2626;
        }

        .card-value {
            font-size: 32px;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 4px;
        }

        .card-label {
            font-size: 14px;
            color: var(--text-muted);
        }

        .card-progress {
            margin-top: 16px;
        }

        .progress-bar {
            height: 6px;
            background: var(--bg-primary);
            border-radius: 3px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            border-radius: 3px;
            transition: width 0.5s ease;
        }

        .progress-fill.green { background: var(--accent); }
        .progress-fill.blue { background: #3b82f6; }
        .progress-fill.orange { background: #f59e0b; }

        .progress-text {
            display: flex;
            justify-content: space-between;
            margin-top: 8px;
            font-size: 12px;
            color: var(--text-muted);
        }

        /* Chart Card */
        .chart-card {
            background: var(--card-bg);
            border-radius: 16px;
            padding: 24px;
            border: 1px solid var(--border);
        }

        .chart-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .chart-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-primary);
        }

        .chart-tabs {
            display: flex;
            gap: 8px;
        }

        .chart-tab {
            padding: 6px 14px;
            border: none;
            background: transparent;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            color: var(--text-muted);
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .chart-tab:hover {
            background: var(--bg-primary);
        }

        .chart-tab.active {
            background: var(--accent);
            color: white;
        }

        .chart-container {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            height: 200px;
            padding: 0 10px;
        }

        .chart-bar-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            flex: 1;
        }

        .chart-bar {
            width: 100%;
            max-width: 40px;
            background: var(--accent-light);
            border-radius: 6px 6px 0 0;
            transition: height 0.5s ease;
            position: relative;
        }

        .chart-bar::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: var(--accent);
            border-radius: 6px 6px 0 0;
            transition: height 0.5s ease;
        }

        .chart-label {
            font-size: 12px;
            color: var(--text-muted);
        }

        /* Workout List */
        .workout-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .workout-item {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 16px;
            background: var(--card-bg);
            border-radius: 12px;
            border: 1px solid var(--border);
            transition: all 0.2s ease;
        }

        .workout-item:hover {
            border-color: var(--accent);
        }

        .workout-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--accent-light);
            color: var(--accent);
        }

        .workout-icon svg {
            width: 24px;
            height: 24px;
        }

        .workout-info {
            flex: 1;
        }

        .workout-name {
            font-size: 15px;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 4px;
        }

        .workout-meta {
            font-size: 13px;
            color: var(--text-muted);
        }

        .workout-stats {
            display: flex;
            gap: 20px;
            text-align: right;
        }

        .workout-stat-value {
            font-size: 15px;
            font-weight: 600;
            color: var(--text-primary);
        }

        .workout-stat-label {
            font-size: 12px;
            color: var(--text-muted);
        }

        .workout-actions {
            display: flex;
            gap: 8px;
        }

        .workout-action-btn {
            padding: 8px 12px;
            border: 1px solid var(--border);
            background: transparent;
            border-radius: 8px;
            cursor: pointer;
            font-size: 13px;
            color: var(--text-secondary);
            transition: all 0.2s ease;
        }

        .workout-action-btn:hover {
            border-color: var(--accent);
            color: var(--accent);
        }

        .workout-action-btn.delete:hover {
            border-color: #ef4444;
            color: #ef4444;
            background: #fee2e2;
        }

        .add-workout-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 20px;
            background: var(--accent);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-bottom: 20px;
        }

        .add-workout-btn:hover {
            background: var(--accent-hover);
            transform: translateY(-1px);
        }

        .add-workout-btn svg {
            width: 18px;
            height: 18px;
        }

        /* Profile Section */
        .profile-header {
            display: flex;
            align-items: center;
            gap: 24px;
            padding: 32px;
            background: var(--card-bg);
            border-radius: 16px;
            border: 1px solid var(--border);
            margin-bottom: 24px;
        }

        .profile-avatar-large {
            width: 100px;
            height: 100px;
            border-radius: 20px;
            object-fit: cover;
            background: var(--accent-light);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            font-weight: 700;
            color: var(--accent);
        }

        .profile-info h2 {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 4px;
        }

        .profile-info p {
            font-size: 14px;
            color: var(--text-muted);
            margin-bottom: 12px;
        }

        .profile-stats {
            display: flex;
            gap: 24px;
        }

        .profile-stat {
            text-align: center;
        }

        .profile-stat-value {
            font-size: 20px;
            font-weight: 700;
            color: var(--accent);
        }

        .profile-stat-label {
            font-size: 12px;
            color: var(--text-muted);
        }

        /* Form Styles */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-label {
            font-size: 14px;
            font-weight: 500;
            color: var(--text-secondary);
        }

        .form-input, .form-select {
            padding: 12px 16px;
            border: 1px solid var(--border);
            border-radius: 10px;
            font-size: 14px;
            background: var(--bg-primary);
            color: var(--text-primary);
            transition: border-color 0.2s ease;
        }

        .form-input:focus, .form-select:focus {
            outline: none;
            border-color: var(--accent);
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-primary {
            background: var(--accent);
            color: white;
        }

        .btn-primary:hover {
            background: var(--accent-hover);
            transform: translateY(-1px);
        }

        .btn-secondary {
            background: var(--bg-primary);
            color: var(--text-secondary);
        }

        .btn-secondary:hover {
            background: var(--border);
        }

        /* Nutrition Section */
        .nutrition-controls {
            background: var(--card-bg);
            border-radius: 16px;
            padding: 24px;
            border: 1px solid var(--border);
            margin-bottom: 24px;
        }

        .nutrition-controls-header {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 16px;
        }

        .controls-row {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            align-items: center;
        }

        .control-group {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .control-group label {
            font-size: 14px;
            color: var(--text-secondary);
            white-space: nowrap;
        }

        .control-group input {
            width: 100px;
            padding: 10px 12px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: var(--bg-primary);
            color: var(--text-primary);
            font-size: 14px;
        }

        .control-group input:focus {
            outline: none;
            border-color: var(--accent);
        }

        .water-tracker {
            background: var(--card-bg);
            border-radius: 16px;
            padding: 24px;
            border: 1px solid var(--border);
            margin-bottom: 24px;
        }

        .water-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }

        .water-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-primary);
        }

        .water-count {
            font-size: 24px;
            font-weight: 700;
            color: var(--info);
        }

        .water-glasses {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(60px, 1fr));
            gap: 12px;
            margin-bottom: 16px;
        }

        .water-glass {
            aspect-ratio: 1;
            border: 2px solid var(--border);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            background: var(--bg-primary);
        }

        .water-glass.filled {
            background: #e0f2fe;
            border-color: var(--info);
            color: var(--info);
        }

        .water-glass:hover {
            transform: scale(1.05);
        }

        .water-glass svg {
            width: 28px;
            height: 28px;
        }

        .water-actions {
            display: flex;
            gap: 12px;
        }

        .water-actions button {
            flex: 1;
            padding: 10px;
            border: 1px solid var(--border);
            background: var(--bg-primary);
            border-radius: 10px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            color: var(--text-secondary);
            transition: all 0.2s ease;
        }

        .water-actions button:hover {
            border-color: var(--info);
            color: var(--info);
        }

        /* Modal */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .modal-overlay.show {
            display: flex;
            opacity: 1;
        }

        .modal {
            background: var(--card-bg);
            border-radius: 20px;
            padding: 28px;
            width: 90%;
            max-width: 420px;
            transform: scale(0.9);
            transition: transform 0.3s ease;
        }

        .modal-overlay.show .modal {
            transform: scale(1);
        }

        .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .modal-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-primary);
        }

        .modal-close {
            width: 36px;
            height: 36px;
            border: none;
            background: var(--bg-primary);
            border-radius: 10px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-secondary);
            transition: all 0.2s ease;
        }

        .modal-close:hover {
            background: var(--border);
        }

        .modal-close svg {
            width: 18px;
            height: 18px;
        }

        .modal-form {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .modal-actions {
            display: flex;
            gap: 12px;
            margin-top: 8px;
        }

        .modal-actions .btn {
            flex: 1;
        }

        /* Toast Notification */
        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 16px 20px;
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 10px;
            box-shadow: 0 8px 24px var(--shadow-lg);
            display: flex;
            align-items: center;
            gap: 12px;
            transform: translateX(150%);
            transition: transform 0.3s ease;
            z-index: 1001;
        }

        .toast.show {
            transform: translateX(0);
        }

        .toast-icon {
            width: 24px;
            height: 24px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .toast-icon.success {
            background: var(--accent-light);
            color: var(--accent);
        }

        .toast-icon.error {
            background: #fee2e2;
            color: #ef4444;
        }

        .toast-content {
            flex: 1;
        }

        .toast-title {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-primary);
        }

        .toast-message {
            font-size: 13px;
            color: var(--text-secondary);
        }

        .toast-close {
            background: none;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            padding: 4px;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .quick-stat {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .main-wrapper {
                margin-left: 0;
            }

            .menu-toggle {
                display: flex;
            }

            .header {
                padding: 16px 20px;
            }

            .header-greeting {
                font-size: 20px;
            }

            .content {
                padding: 20px;
            }

            .profile-header {
                flex-direction: column;
                text-align: center;
            }

            .profile-stats {
                justify-content: center;
            }

            .overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 99;
            }

            .overlay.show {
                display: block;
            }
        }

        /* Utility */
        .hidden {
            display: none !important;
        }

        .stat-difference {
            font-size: 12px;
            display: flex;
            align-items: center;
            gap: 4px;
            margin-top: 4px;
        }

        .stat-difference.positive {
            color: #16a34a;
        }

        .stat-difference.negative {
            color: #dc2626;
        }
    </style>
</head>
<body>
    <div class="overlay" id="overlay"></div>
    
    <div class="dashboard">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <div class="logo-icon">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M20.57 14.86L22 13.43 20.57 12 17 15.57 8.43 7 12 3.43 10.57 2 9.14 3.43 7.71 2 5.57 4.14 4.14 2.71 2.71 4.14l1.43 1.43L2 7.71l1.43 1.43L2 10.57 3.43 12 7 8.43 15.57 17 12 20.57 13.43 22l1.43-1.43L16.29 22l2.14-2.14 1.43 1.43 1.43-1.43-1.43-1.43L22 16.29z"/>
                        </svg>
                    </div>
                    <span class="logo-text">FitLife</span>
                </div>
            </div>

            <nav class="sidebar-nav">
                <div class="nav-section">
                    <div class="nav-section-title">Main</div>
                    <button class="nav-btn active" data-section="dashboard">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="3" width="7" height="7" rx="1"/>
                            <rect x="14" y="3" width="7" height="7" rx="1"/>
                            <rect x="3" y="14" width="7" height="7" rx="1"/>
                            <rect x="14" y="14" width="7" height="7" rx="1"/>
                        </svg>
                        Dashboard
                    </button>
                    <button class="nav-btn" data-section="profile">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="8" r="4"/>
                            <path d="M20 21a8 8 0 1 0-16 0"/>
                        </svg>
                        Profile
                    </button>
                    <button class="nav-btn" data-section="nutrition">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 2a10 10 0 1 0 10 10 4 4 0 0 1-5-5 4 4 0 0 1-5-5"/>
                            <path d="M8.5 8.5v.01"/>
                            <path d="M16 15.5v.01"/>
                            <path d="M12 12v.01"/>
                            <path d="M11 17v.01"/>
                            <path d="M7 14v.01"/>
                        </svg>
                        Nutrition
                    </button>
                    <button class="nav-btn" data-section="workouts">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M6.5 6.5h11"/>
                            <path d="M6.5 17.5h11"/>
                            <path d="M4 10V6.5a2 2 0 0 1 2-2h1"/>
                            <path d="M4 14v3.5a2 2 0 0 0 2 2h1"/>
                            <path d="M20 10V6.5a2 2 0 0 0-2-2h-1"/>
                            <path d="M20 14v3.5a2 2 0 0 1-2 2h-1"/>
                            <path d="M12 6.5v11"/>
                        </svg>
                        Workouts
                    </button>
                    <button class="nav-btn" data-section="progress">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 3v18h18"/>
                            <path d="M18 17V9"/>
                            <path d="M13 17V5"/>
                            <path d="M8 17v-3"/>
                        </svg>
                        Progress
                    </button>
                </div>
            </nav>

            <div class="sidebar-footer">
                <div class="user-card">
                    <div class="user-avatar" id="sidebarAvatar">U</div>
                    <div class="user-info">
                        <div class="user-name" id="sidebarUserName">User</div>
                        <div class="user-email" id="sidebarUserEmail">user@email.com</div>
                    </div>
                </div>
                <div class="theme-toggle">
                    <div class="theme-toggle-label">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"/>
                        </svg>
                        Night Mode
                    </div>
                    <div class="toggle-switch" id="themeToggle"></div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="main-wrapper">
            <header class="header">
                <div class="header-left">
                    <div class="header-date" id="currentDate"></div>
                    <div class="header-greeting" id="greeting">Good Morning</div>
                </div>
                <div class="header-right">
                    <div class="quick-stat">
                        <div class="quick-stat-icon calories">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 12c-2-2.67-4-4-4-5.5a4 4 0 0 1 8 0c0 1.5-2 2.83-4 5.5"/>
                                <path d="M12 21c-4 0-6-2-6-5 0-4 4-6.5 6-10 2 3.5 6 6 6 10 0 3-2 5-6 5"/>
                            </svg>
                        </div>
                        <div class="quick-stat-info">
                            <div class="quick-stat-value" id="headerCalories">0</div>
                            <div class="quick-stat-label">Calories</div>
                        </div>
                    </div>
                    <div class="quick-stat">
                        <div class="quick-stat-icon steps">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M4 16v-2.38C4 11.5 2.97 10.5 3 8c.03-2.72 1.49-6 4.5-6C9.37 2 10 3.8 10 5.5c0 3.11-2 5.66-2 8.68V16a2 2 0 1 1-4 0Z"/>
                                <path d="M20 20v-2.38c0-2.12 1.03-3.12 1-5.62-.03-2.72-1.49-6-4.5-6C14.63 6 14 7.8 14 9.5c0 3.11 2 5.66 2 8.68V20a2 2 0 1 0 4 0Z"/>
                            </svg>
                        </div>
                        <div class="quick-stat-info">
                            <div class="quick-stat-value" id="headerSteps">0</div>
                            <div class="quick-stat-label">Steps</div>
                        </div>
                    </div>
                    <div class="quick-stat">
                        <div class="quick-stat-icon water">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 22a7 7 0 0 0 7-7c0-2-1-3.9-3-5.5s-3.5-4-4-6.5c-.5 2.5-2 4.9-4 6.5C6 11.1 5 13 5 15a7 7 0 0 0 7 7z"/>
                            </svg>
                        </div>
                        <div class="quick-stat-info">
                            <div class="quick-stat-value" id="headerWater">0/8</div>
                            <div class="quick-stat-label">Glasses</div>
                        </div>
                    </div>
                    <button class="menu-toggle" id="menuToggle">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="3" y1="12" x2="21" y2="12"/>
                            <line x1="3" y1="6" x2="21" y2="6"/>
                            <line x1="3" y1="18" x2="21" y2="18"/>
                        </svg>
                    </button>
                </div>
            </header>

            <main class="content">
                <!-- Dashboard Section -->
                <section class="section active" id="dashboard">
                    <div class="section-header">
                        <h1 class="section-title">Dashboard</h1>
                        <p class="section-subtitle">Track your daily fitness progress</p>
                    </div>

                    <div class="cards-grid">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-icon green">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M12 12c-2-2.67-4-4-4-5.5a4 4 0 0 1 8 0c0 1.5-2 2.83-4 5.5"/>
                                        <path d="M12 21c-4 0-6-2-6-5 0-4 4-6.5 6-10 2 3.5 6 6 6 10 0 3-2 5-6 5"/>
                                    </svg>
                                </div>
                                <span class="card-badge up" id="caloriesBadge">+0%</span>
                            </div>
                            <div class="card-value" id="dashboardCalories">0</div>
                            <div class="card-label">Calories Burned</div>
                            <div class="card-progress">
                                <div class="progress-bar">
                                    <div class="progress-fill green" id="caloriesProgress" style="width: 0%"></div>
                                </div>
                                <div class="progress-text">
                                    <span id="caloriesPercent">0% of goal</span>
                                    <span id="caloriesGoal">2000 cal</span>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <div class="card-icon blue">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M4 16v-2.38C4 11.5 2.97 10.5 3 8c.03-2.72 1.49-6 4.5-6C9.37 2 10 3.8 10 5.5c0 3.11-2 5.66-2 8.68V16a2 2 0 1 1-4 0Z"/>
                                        <path d="M20 20v-2.38c0-2.12 1.03-3.12 1-5.62-.03-2.72-1.49-6-4.5-6C14.63 6 14 7.8 14 9.5c0 3.11 2 5.66 2 8.68V20a2 2 0 1 0 4 0Z"/>
                                    </svg>
                                </div>
                                <span class="card-badge up" id="stepsBadge">+0%</span>
                            </div>
                            <div class="card-value" id="dashboardSteps">0</div>
                            <div class="card-label">Steps Today</div>
                            <div class="card-progress">
                                <div class="progress-bar">
                                    <div class="progress-fill blue" id="stepsProgress" style="width: 0%"></div>
                                </div>
                                <div class="progress-text">
                                    <span id="stepsPercent">0% of goal</span>
                                    <span>10,000 steps</span>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <div class="card-icon orange">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="12" r="10"/>
                                        <polyline points="12 6 12 12 16 14"/>
                                    </svg>
                                </div>
                                <span class="card-badge up" id="activeBadge">+0%</span>
                            </div>
                            <div class="card-value" id="dashboardActiveTime">0 min</div>
                            <div class="card-label">Active Time</div>
                            <div class="card-progress">
                                <div class="progress-bar">
                                    <div class="progress-fill orange" id="activeProgress" style="width: 0%"></div>
                                </div>
                                <div class="progress-text">
                                    <span id="activePercent">0% of goal</span>
                                    <span>60 min</span>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <div class="card-icon purple">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M12 22a7 7 0 0 0 7-7c0-2-1-3.9-3-5.5s-3.5-4-4-6.5c-.5 2.5-2 4.9-4 6.5C6 11.1 5 13 5 15a7 7 0 0 0 7 7z"/>
                                    </svg>
                                </div>
                                <span class="card-badge down" id="waterBadge">0/8</span>
                            </div>
                            <div class="card-value" id="dashboardWater">0/8</div>
                            <div class="card-label">Water Intake</div>
                            <div class="card-progress">
                                <div class="progress-bar">
                                    <div class="progress-fill green" id="waterProgress" style="width: 0%"></div>
                                </div>
                                <div class="progress-text">
                                    <span id="waterCount">0 glasses</span>
                                    <span id="waterGoalDisplay">8 glasses</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="chart-card">
                        <div class="chart-header">
                            <h3 class="chart-title">Weekly Activity</h3>
                            <div class="chart-tabs">
                                <button class="chart-tab active">Week</button>
                                <button class="chart-tab">Month</button>
                                <button class="chart-tab">Year</button>
                            </div>
                        </div>
                        <div class="chart-container" id="activityChart"></div>
                    </div>
                </section>

                <!-- Profile Section -->
                <section class="section" id="profile">
                    <div class="section-header">
                        <h1 class="section-title">Profile</h1>
                        <p class="section-subtitle">Manage your personal information</p>
                    </div>

                    <div class="profile-header">
                        <div class="profile-avatar-large" id="profileAvatar">U</div>
                        <div class="profile-info">
                            <h2 id="profileName">User</h2>
                            <p>Fitness enthusiast since 2024</p>
                            <div class="profile-stats">
                                <div class="profile-stat">
                                    <div class="profile-stat-value" id="totalWorkouts">0</div>
                                    <div class="profile-stat-label">Workouts</div>
                                </div>
                                <div class="profile-stat">
                                    <div class="profile-stat-value" id="dayStreak">0</div>
                                    <div class="profile-stat-label">Day Streak</div>
                                </div>
                                <div class="profile-stat">
                                    <div class="profile-stat-value" id="weightLost">0kg</div>
                                    <div class="profile-stat-label">Progress</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <h3 style="margin-bottom: 20px; font-size: 18px; color: var(--text-primary);">Personal Information</h3>
                        <form id="profileForm">
                            <div class="form-grid">
                                <div class="form-group">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" class="form-input" id="profileNameInput" placeholder="Enter your name">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-input" id="profileEmailInput" placeholder="your@email.com">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Age</label>
                                    <input type="number" class="form-input" id="profileAgeInput" placeholder="25" min="13" max="100">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Weight (kg)</label>
                                    <input type="number" class="form-input" id="profileWeightInput" placeholder="70" min="30" max="300">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Height (cm)</label>
                                    <input type="number" class="form-input" id="profileHeightInput" placeholder="175" min="100" max="250">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Activity Level</label>
                                    <select class="form-select" id="profileActivityInput">
                                        <option value="sedentary">Sedentary</option>
                                        <option value="light">Light Activity</option>
                                        <option value="moderate">Moderate Activity</option>
                                        <option value="very">Very Active</option>
                                    </select>
                                </div>
                            </div>
                            <div style="margin-top: 24px; display: flex; gap: 12px;">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                <button type="button" class="btn btn-secondary" onclick="loadProfileData()">Cancel</button>
                            </div>
                        </form>
                    </div>
                </section>

                <!-- Nutrition Section -->
                <section class="section" id="nutrition">
                    <div class="section-header">
                        <h1 class="section-title">Nutrition</h1>
                        <p class="section-subtitle">Track your daily calorie intake and water consumption</p>
                    </div>

                    <!-- Nutrition Controls -->
                    <div class="nutrition-controls">
                        <div class="nutrition-controls-header">Daily Goals</div>
                        <div class="controls-row">
                            <div class="control-group">
                                <label for="calorieGoalInput">Calorie Goal:</label>
                                <input type="number" id="calorieGoalInput" value="2000" min="500" max="10000" step="100">
                                <span style="color: var(--text-muted); font-size: 14px;">cal</span>
                            </div>
                            <div class="control-group">
                                <label for="waterGoalInput">Water Goal:</label>
                                <input type="number" id="waterGoalInput" value="8" min="1" max="20">
                                <span style="color: var(--text-muted); font-size: 14px;">glasses</span>
                            </div>
                        </div>
                    </div>

                    <!-- Water Tracker -->
                    <div class="water-tracker">
                        <div class="water-header">
                            <div class="water-title">Water Intake</div>
                            <div class="water-count"><span id="waterCurrent">0</span> / <span id="waterGoalText">8</span></div>
                        </div>
                        <div class="water-glasses" id="waterGlasses"></div>
                        <div class="water-actions">
                            <button onclick="addWaterGlass()">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 16px; height: 16px; margin-right: 6px;">
                                    <path d="M12 5v14"/>
                                    <path d="M5 12h14"/>
                                </svg>
                                Add Glass
                            </button>
                            <button onclick="resetWater()">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 16px; height: 16px; margin-right: 6px;">
                                    <path d="M3 12a9 9 0 0 1 9-9 9.75 9.75 0 0 1 6.74 2.74L21 8"/>
                                    <path d="M21 3v5h-5"/>
                                    <path d="M21 12a9 9 0 0 1-9 9 9.75 9.75 0 0 1-6.74-2.74L3 16"/>
                                    <path d="M3 21v-5h5"/>
                                </svg>
                                Reset
                            </button>
                        </div>
                    </div>

                    <!-- Calorie Summary -->
                    <div class="card">
                        <h3 style="margin-bottom: 16px; font-size: 18px; color: var(--text-primary);">Calorie Summary</h3>
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                            <div>
                                <div style="font-size: 32px; font-weight: 700; color: var(--accent);"><span id="caloriesConsumed">0</span> cal</div>
                                <div style="font-size: 14px; color: var(--text-muted);">of <span id="calorieGoalText">2000</span> cal goal</div>
                            </div>
                            <div style="text-align: right;">
                                <div style="font-size: 20px; font-weight: 600; color: var(--text-secondary);"><span id="caloriesRemaining">2000</span> cal</div>
                                <div style="font-size: 14px; color: var(--text-muted);">remaining</div>
                            </div>
                        </div>
                        <div class="progress-bar" style="height: 12px;">
                            <div class="progress-fill green" id="nutritionProgress" style="width: 0%"></div>
                        </div>
                        <div style="margin-top: 16px; display: flex; gap: 12px;">
                            <button class="btn btn-primary" onclick="openCalorieModal()">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 18px; height: 18px; margin-right: 6px;">
                                    <path d="M12 5v14"/>
                                    <path d="M5 12h14"/>
                                </svg>
                                Add Calories
                            </button>
                            <button class="btn btn-secondary" onclick="resetCalories()">Reset</button>
                        </div>
                    </div>
                </section>

                <!-- Workouts Section -->
                <section class="section" id="workouts">
                    <div class="section-header">
                        <h1 class="section-title">Workouts</h1>
                        <p class="section-subtitle">Your exercise routines and history</p>
                    </div>

                    <button class="add-workout-btn" onclick="openWorkoutModal()">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 5v14"/>
                            <path d="M5 12h14"/>
                        </svg>
                        Add Workout
                    </button>

                    <div class="cards-grid" style="margin-bottom: 24px;">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-icon green">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M6.5 6.5h11"/>
                                        <path d="M6.5 17.5h11"/>
                                        <path d="M12 6.5v11"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="card-value" id="weekWorkouts">0</div>
                            <div class="card-label">Workouts This Week</div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <div class="card-icon blue">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="12" r="10"/>
                                        <polyline points="12 6 12 12 16 14"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="card-value" id="totalDuration">0h</div>
                            <div class="card-label">Total Duration</div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <div class="card-icon orange">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M12 12c-2-2.67-4-4-4-5.5a4 4 0 0 1 8 0c0 1.5-2 2.83-4 5.5"/>
                                        <path d="M12 21c-4 0-6-2-6-5 0-4 4-6.5 6-10 2 3.5 6 6 6 10 0 3-2 5-6 5"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="card-value" id="totalCaloriesBurned">0</div>
                            <div class="card-label">Calories Burned</div>
                        </div>
                    </div>

                    <h3 style="margin-bottom: 16px; font-size: 18px; color: var(--text-primary);">Recent Workouts</h3>
                    <div class="workout-list" id="workoutList"></div>
                </section>

                <!-- Progress Section -->
                <section class="section" id="progress">
                    <div class="section-header">
                        <h1 class="section-title">Progress</h1>
                        <p class="section-subtitle">Track your fitness journey over time</p>
                    </div>

                    <div class="cards-grid">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-icon green">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M3 3v18h18"/>
                                        <path d="m7 16 4-8 4 4 6-8"/>
                                    </svg>
                                </div>
                                <span class="card-badge up" id="weightChangeBadge">0kg</span>
                            </div>
                            <div class="card-value" id="currentWeight">0 kg</div>
                            <div class="card-label">Current Weight</div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <div class="card-icon blue">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M12 22V2"/>
                                        <path d="m5 12 7-7 7 7"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="card-value" id="goalWeight">0 kg</div>
                            <div class="card-label">Goal Weight</div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <div class="card-icon orange">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M8 2v4"/>
                                        <path d="M16 2v4"/>
                                        <rect x="3" y="4" width="18" height="18" rx="2"/>
                                        <path d="M3 10h18"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="card-value" id="progressStreak">0</div>
                            <div class="card-label">Day Streak</div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <div class="card-icon purple">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M12 2L2 7l10 5 10-5-10-5Z"/>
                                        <path d="m2 17 10 5 10-5"/>
                                        <path d="m2 12 10 5 10-5"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="card-value" id="progressTotalWorkouts">0</div>
                            <div class="card-label">Total Workouts</div>
                        </div>
                    </div>

                    <div class="chart-card" style="margin-top: 24px;">
                        <div class="chart-header">
                            <h3 class="chart-title">Weight Progress</h3>
                            <div class="chart-tabs">
                                <button class="chart-tab">1M</button>
                                <button class="chart-tab active">3M</button>
                                <button class="chart-tab">6M</button>
                            </div>
                        </div>
                        <div class="chart-container" id="weightChart"></div>
                    </div>
                </section>
            </main>
        </div>
    </div>

    <!-- Toast Notification -->
    <div class="toast" id="toast">
        <div class="toast-icon success" id="toastIcon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 16px; height: 16px;">
                <path d="M20 6L9 17l-5-5"/>
            </svg>
        </div>
        <div class="toast-content">
            <div class="toast-title" id="toastTitle">Success</div>
            <div class="toast-message" id="toastMessage">Operation completed successfully</div>
        </div>
        <button class="toast-close" onclick="hideToast()">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 16px; height: 16px;">
                <path d="M18 6L6 18"/>
                <path d="M6 6l12 12"/>
            </svg>
        </button>
    </div>

    <!-- Add Calorie Modal -->
    <div class="modal-overlay" id="calorieModal">
        <div class="modal">
            <div class="modal-header">
                <div class="modal-title">Add Calories</div>
                <button class="modal-close" onclick="closeCalorieModal()">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M18 6L6 18"/>
                        <path d="M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <form class="modal-form" id="calorieForm" onsubmit="addCalories(event)">
                <div class="form-group">
                    <label class="form-label">Meal/Food Name</label>
                    <input type="text" class="form-input" id="mealName" placeholder="e.g., Breakfast, Chicken Salad" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Calories</label>
                    <input type="number" class="form-input" id="calorieAmount" placeholder="Enter calories" min="1" required>
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeCalorieModal()">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Add Workout Modal -->
    <div class="modal-overlay" id="workoutModal">
        <div class="modal">
            <div class="modal-header">
                <div class="modal-title" id="workoutModalTitle">Add Workout</div>
                <button class="modal-close" onclick="closeWorkoutModal()">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M18 6L6 18"/>
                        <path d="M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <form class="modal-form" id="workoutForm" onsubmit="saveWorkout(event)">
                <input type="hidden" id="editWorkoutIndex" value="-1">
                <div class="form-group">
                    <label class="form-label">Workout Name</label>
                    <input type="text" class="form-input" id="workoutName" placeholder="e.g., Morning Run, Gym Session" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Duration (minutes)</label>
                    <input type="number" class="form-input" id="workoutDuration" placeholder="Enter duration" min="1" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Calories Burned</label>
                    <input type="number" class="form-input" id="workoutCalories" placeholder="Enter calories burned" min="1" required>
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeWorkoutModal()">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="workoutSubmitBtn">Add Workout</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Enhanced FitLife Dashboard
        class FitLifeDashboard {
            constructor() {
                this.userData = {
                    name: 'User',
                    email: 'user@email.com',
                    age: 25,
                    height: 175,
                    weight: 70,
                    goal: 'maintain',
                    frequency: 3,
                    duration: 45,
                    activities: '',
                    calorieGoal: 2000,
                    waterGoal: 8,
                    waterConsumed: 0,
                    caloriesConsumed: 0,
                    stepsToday: 3450,
                    activeMinutes: 45,
                    workouts: [],
                    initialWeight: 70,
                    activityLevel: 'moderate'
                };
                
                this.init();
            }
            
            init() {
                this.loadFromURLParams();
                this.loadUserData();
                this.setupEventListeners();
                this.initCharts();
                this.updateUI();
            }
            
            loadFromURLParams() {
                const urlParams = new URLSearchParams(window.location.search);
                if (urlParams.has('name')) {
                    this.userData.name = urlParams.get('name') || 'User';
                    this.userData.email = urlParams.get('email') || '';
                    this.userData.age = parseInt(urlParams.get('age')) || 25;
                    this.userData.height = parseInt(urlParams.get('height')) || 175;
                    this.userData.weight = parseInt(urlParams.get('weight')) || 70;
                    this.userData.initialWeight = this.userData.weight;
                    this.userData.goal = urlParams.get('goal') || 'maintain';
                    this.userData.frequency = parseInt(urlParams.get('frequency')) || 3;
                    this.userData.duration = parseInt(urlParams.get('duration')) || 45;
                    this.userData.activities = urlParams.get('activities') || '';
                    this.saveUserData();
                }
            }
            
            loadUserData() {
                const saved = localStorage.getItem('fitLifeUserData');
                if (saved) {
                    this.userData = { ...this.userData, ...JSON.parse(saved) };
                }
            }
            
            saveUserData() {
                localStorage.setItem('fitLifeUserData', JSON.stringify(this.userData));
            }
            
            setupEventListeners() {
                // Theme toggle
                const themeToggle = document.getElementById('themeToggle');
                themeToggle.addEventListener('click', () => {
                    themeToggle.classList.toggle('active');
                    const isDark = themeToggle.classList.contains('active');
                    document.body.setAttribute('data-theme', isDark ? 'dark' : 'light');
                    localStorage.setItem('theme', isDark ? 'dark' : 'light');
                });
                
                // Load saved theme
                if (localStorage.getItem('theme') === 'dark') {
                    themeToggle.classList.add('active');
                    document.body.setAttribute('data-theme', 'dark');
                }
                
                // Navigation
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('overlay');
                const menuToggle = document.getElementById('menuToggle');
                const navBtns = document.querySelectorAll('.nav-btn');
                const sections = document.querySelectorAll('.section');
                
                menuToggle.addEventListener('click', () => {
                    sidebar.classList.toggle('open');
                    overlay.classList.toggle('show');
                });
                
                overlay.addEventListener('click', () => {
                    sidebar.classList.remove('open');
                    overlay.classList.remove('show');
                });
                
                navBtns.forEach(btn => {
                    btn.addEventListener('click', () => {
                        const sectionId = btn.dataset.section;
                        
                        navBtns.forEach(b => b.classList.remove('active'));
                        btn.classList.add('active');
                        
                        sections.forEach(section => {
                            section.classList.remove('active');
                            if (section.id === sectionId) {
                                section.classList.add('active');
                            }
                        });
                        
                        sidebar.classList.remove('open');
                        overlay.classList.remove('show');
                    });
                });
                
                // Form submissions
                document.getElementById('profileForm').addEventListener('submit', (e) => {
                    e.preventDefault();
                    this.saveProfile();
                });
                
                // Nutrition controls
                document.getElementById('calorieGoalInput').addEventListener('change', (e) => {
                    this.userData.calorieGoal = parseInt(e.target.value) || 2000;
                    this.saveUserData();
                    this.updateNutritionStats();
                });
                
                document.getElementById('waterGoalInput').addEventListener('change', (e) => {
                    this.userData.waterGoal = parseInt(e.target.value) || 8;
                    if (this.userData.waterConsumed > this.userData.waterGoal) {
                        this.userData.waterConsumed = this.userData.waterGoal;
                    }
                    this.saveUserData();
                    this.updateNutritionStats();
                });
                
                // Set current date
                const dateElement = document.getElementById('currentDate');
                const now = new Date();
                const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                dateElement.textContent = now.toLocaleDateString('en-US', options);
                
                // Initialize demo workouts if none exist
                if (this.userData.workouts.length === 0) {
                    this.generateDemoWorkouts();
                }
            }
            
            generateDemoWorkouts() {
                const demoWorkouts = [
                    { name: 'Morning Run', duration: 30, calories: 300, date: new Date(Date.now() - 86400000).toISOString() },
                    { name: 'Gym Session', duration: 60, calories: 450, date: new Date(Date.now() - 2 * 86400000).toISOString() },
                    { name: 'Yoga', duration: 45, calories: 180, date: new Date(Date.now() - 3 * 86400000).toISOString() },
                    { name: 'Cycling', duration: 40, calories: 350, date: new Date(Date.now() - 5 * 86400000).toISOString() }
                ];
                
                this.userData.workouts = demoWorkouts;
                this.saveUserData();
            }
            
            updateUI() {
                this.updateUserInfo();
                this.updateDashboardStats();
                this.updateNutritionStats();
                this.updateWorkoutStats();
                this.updateProgressStats();
            }
            
            updateUserInfo() {
                const initials = this.userData.name.split(' ').map(n => n[0]).join('').toUpperCase() || 'U';
                
                // Update avatar and names
                document.getElementById('sidebarAvatar').textContent = initials;
                document.getElementById('sidebarUserName').textContent = this.userData.name;
                document.getElementById('sidebarUserEmail').textContent = this.userData.email;
                document.getElementById('profileAvatar').textContent = initials;
                document.getElementById('profileName').textContent = this.userData.name;
                
                // Update greeting
                const hour = new Date().getHours();
                let greeting = 'Good Morning';
                if (hour >= 12 && hour < 17) greeting = 'Good Afternoon';
                if (hour >= 17) greeting = 'Good Evening';
                document.getElementById('greeting').textContent = `${greeting}, ${this.userData.name.split(' ')[0] || 'User'}`;
            }
            
            updateDashboardStats() {
                const totalCaloriesBurned = this.userData.workouts.reduce((sum, w) => sum + (w.calories || 0), 0);
                const calorieGoal = this.userData.calorieGoal;
                const caloriePercent = Math.min((totalCaloriesBurned / calorieGoal) * 100, 100);
                
                const stepsGoal = 10000;
                const stepsPercent = Math.min((this.userData.stepsToday / stepsGoal) * 100, 100);
                
                const activeGoal = 60;
                const activePercent = Math.min((this.userData.activeMinutes / activeGoal) * 100, 100);
                
                const waterPercent = Math.min((this.userData.waterConsumed / this.userData.waterGoal) * 100, 100);
                
                // Update header quick stats
                document.getElementById('headerCalories').textContent = totalCaloriesBurned.toLocaleString();
                document.getElementById('headerSteps').textContent = this.userData.stepsToday.toLocaleString();
                document.getElementById('headerWater').textContent = `${this.userData.waterConsumed}/${this.userData.waterGoal}`;
                
                // Update dashboard cards
                document.getElementById('dashboardCalories').textContent = totalCaloriesBurned.toLocaleString();
                document.getElementById('caloriesProgress').style.width = caloriePercent + '%';
                document.getElementById('caloriesPercent').textContent = Math.round(caloriePercent) + '% of goal';
                document.getElementById('caloriesGoal').textContent = calorieGoal + ' cal';
                document.getElementById('caloriesBadge').textContent = '+' + Math.round(caloriePercent) + '%';
                
                document.getElementById('dashboardSteps').textContent = this.userData.stepsToday.toLocaleString();
                document.getElementById('stepsProgress').style.width = stepsPercent + '%';
                document.getElementById('stepsPercent').textContent = Math.round(stepsPercent) + '% of goal';
                document.getElementById('stepsBadge').textContent = '+' + Math.round(stepsPercent) + '%';
                
                document.getElementById('dashboardActiveTime').textContent = this.userData.activeMinutes + ' min';
                document.getElementById('activeProgress').style.width = activePercent + '%';
                document.getElementById('activePercent').textContent = Math.round(activePercent) + '% of goal';
                document.getElementById('activeBadge').textContent = '+' + Math.round(activePercent) + '%';
                
                document.getElementById('dashboardWater').textContent = `${this.userData.waterConsumed}/${this.userData.waterGoal}`;
                document.getElementById('waterProgress').style.width = waterPercent + '%';
                document.getElementById('waterCount').textContent = this.userData.waterConsumed + ' glasses';
                document.getElementById('waterGoalDisplay').textContent = this.userData.waterGoal + ' glasses';
                document.getElementById('waterBadge').textContent = `${this.userData.waterConsumed}/${this.userData.waterGoal}`;
            }
            
            updateNutritionStats() {
                const goal = this.userData.calorieGoal;
                const consumed = this.userData.caloriesConsumed;
                const remaining = Math.max(goal - consumed, 0);
                const percent = Math.min((consumed / goal) * 100, 100);
                
                document.getElementById('calorieGoalInput').value = goal;
                document.getElementById('waterGoalInput').value = this.userData.waterGoal;
                document.getElementById('caloriesConsumed').textContent = consumed.toLocaleString();
                document.getElementById('calorieGoalText').textContent = goal.toLocaleString();
                document.getElementById('caloriesRemaining').textContent = remaining.toLocaleString();
                document.getElementById('nutritionProgress').style.width = percent + '%';
                
                // Update water tracker
                document.getElementById('waterCurrent').textContent = this.userData.waterConsumed;
                document.getElementById('waterGoalText').textContent = this.userData.waterGoal;
                this.renderWaterGlasses();
            }
            
            renderWaterGlasses() {
                const container = document.getElementById('waterGlasses');
                container.innerHTML = '';
                
                for (let i = 0; i < this.userData.waterGoal; i++) {
                    const glass = document.createElement('div');
                    glass.className = 'water-glass' + (i < this.userData.waterConsumed ? ' filled' : '');
                    glass.onclick = () => this.toggleWaterGlass(i);
                    glass.innerHTML = `
                        <svg viewBox="0 0 24 24" fill="${i < this.userData.waterConsumed ? 'currentColor' : 'none'}" stroke="currentColor" stroke-width="2">
                            <path d="M12 22a7 7 0 0 0 7-7c0-2-1-3.9-3-5.5s-3.5-4-4-6.5c-.5 2.5-2 4.9-4 6.5C6 11.1 5 13 5 15a7 7 0 0 0 7 7z"/>
                        </svg>
                    `;
                    container.appendChild(glass);
                }
            }
            
            toggleWaterGlass(index) {
                if (index < this.userData.waterConsumed) {
                    this.userData.waterConsumed = index;
                } else {
                    this.userData.waterConsumed = index + 1;
                }
                this.saveUserData();
                this.updateNutritionStats();
                this.updateDashboardStats();
            }
            
            addWaterGlass() {
                if (this.userData.waterConsumed < this.userData.waterGoal) {
                    this.userData.waterConsumed++;
                    this.saveUserData();
                    this.updateNutritionStats();
                    this.updateDashboardStats();
                }
            }
            
            resetWater() {
                if (confirm('Are you sure you want to reset your water intake for today?')) {
                    this.userData.waterConsumed = 0;
                    this.saveUserData();
                    this.updateNutritionStats();
                    this.updateDashboardStats();
                }
            }
            
            openCalorieModal() {
                document.getElementById('calorieModal').classList.add('show');
                document.getElementById('calorieForm').reset();
            }
            
            closeCalorieModal() {
                document.getElementById('calorieModal').classList.remove('show');
            }
            
            addCalories(event) {
                event.preventDefault();
                const amount = parseInt(document.getElementById('calorieAmount').value);
                const mealName = document.getElementById('mealName').value;
                
                this.userData.caloriesConsumed += amount;
                this.saveUserData();
                this.updateNutritionStats();
                this.closeCalorieModal();
                this.showToast('Calories Added', `Added ${amount} calories for "${mealName}"`);
            }
            
            resetCalories() {
                if (confirm('Are you sure you want to reset your calorie count for today?')) {
                    this.userData.caloriesConsumed = 0;
                    this.saveUserData();
                    this.updateNutritionStats();
                    this.showToast('Calories Reset', 'Calorie count has been reset to 0');
                }
            }
            
            updateWorkoutStats() {
                const now = new Date();
                const weekAgo = new Date(now.getTime() - 7 * 24 * 60 * 60 * 1000);
                
                const weekWorkouts = this.userData.workouts.filter(w => {
                    const workoutDate = new Date(w.date);
                    return workoutDate >= weekAgo;
                }).length;
                
                const totalDuration = this.userData.workouts.reduce((sum, w) => sum + (w.duration || 0), 0);
                const totalCalories = this.userData.workouts.reduce((sum, w) => sum + (w.calories || 0), 0);
                
                document.getElementById('weekWorkouts').textContent = weekWorkouts;
                document.getElementById('totalDuration').textContent = (totalDuration / 60).toFixed(1) + 'h';
                document.getElementById('totalCaloriesBurned').textContent = totalCalories.toLocaleString();
                
                // Update active minutes from today's workouts
                const today = new Date();
                today.setHours(0, 0, 0, 0);
                
                this.userData.activeMinutes = this.userData.workouts
                    .filter(w => {
                        const workoutDate = new Date(w.date);
                        workoutDate.setHours(0, 0, 0, 0);
                        return workoutDate.getTime() === today.getTime();
                    })
                    .reduce((sum, w) => sum + (w.duration || 0), 0);
                
                this.renderWorkoutList();
            }
            
            renderWorkoutList() {
                const container = document.getElementById('workoutList');
                
                if (this.userData.workouts.length === 0) {
                    container.innerHTML = '<div class="card"><p style="text-align: center; color: var(--text-muted); padding: 40px 20px;">No workouts yet. Click "Add Workout" to get started!</p></div>';
                    return;
                }
                
                container.innerHTML = this.userData.workouts.map((workout, index) => {
                    const date = new Date(workout.date);
                    const timeAgo = this.getTimeAgo(date);
                    
                    return `
                        <div class="workout-item">
                            <div class="workout-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M6.5 6.5h11"/>
                                    <path d="M6.5 17.5h11"/>
                                    <path d="M12 6.5v11"/>
                                </svg>
                            </div>
                            <div class="workout-info">
                                <div class="workout-name">${workout.name}</div>
                                <div class="workout-meta">${timeAgo}</div>
                            </div>
                            <div class="workout-stats">
                                <div>
                                    <div class="workout-stat-value">${workout.duration} min</div>
                                    <div class="workout-stat-label">Duration</div>
                                </div>
                                <div>
                                    <div class="workout-stat-value">${workout.calories} cal</div>
                                    <div class="workout-stat-label">Burned</div>
                                </div>
                            </div>
                            <div class="workout-actions">
                                <button class="workout-action-btn" onclick="dashboard.editWorkout(${index})">Edit</button>
                                <button class="workout-action-btn delete" onclick="dashboard.deleteWorkout(${index})">Delete</button>
                            </div>
                        </div>
                    `;
                }).join('');
            }
            
            getTimeAgo(date) {
                const now = new Date();
                const diffMs = now - date;
                const diffMins = Math.floor(diffMs / 60000);
                const diffHours = Math.floor(diffMs / 3600000);
                const diffDays = Math.floor(diffMs / 86400000);
                
                if (diffMins < 60) return `${diffMins} minute${diffMins !== 1 ? 's' : ''} ago`;
                if (diffHours < 24) return `${diffHours} hour${diffHours !== 1 ? 's' : ''} ago`;
                if (diffDays === 0) return 'Today';
                if (diffDays === 1) return 'Yesterday';
                if (diffDays < 7) return `${diffDays} days ago`;
                return date.toLocaleDateString();
            }
            
            openWorkoutModal() {
                document.getElementById('workoutModalTitle').textContent = 'Add Workout';
                document.getElementById('workoutSubmitBtn').textContent = 'Add Workout';
                document.getElementById('editWorkoutIndex').value = '-1';
                document.getElementById('workoutForm').reset();
                document.getElementById('workoutModal').classList.add('show');
            }
            
            closeWorkoutModal() {
                document.getElementById('workoutModal').classList.remove('show');
            }
            
            saveWorkout(event) {
                event.preventDefault();
                
                const name = document.getElementById('workoutName').value;
                const duration = parseInt(document.getElementById('workoutDuration').value);
                const calories = parseInt(document.getElementById('workoutCalories').value);
                const editIndex = parseInt(document.getElementById('editWorkoutIndex').value);
                
                const workout = {
                    name,
                    duration,
                    calories,
                    date: new Date().toISOString()
                };
                
                if (editIndex >= 0) {
                    this.userData.workouts[editIndex] = workout;
                } else {
                    this.userData.workouts.unshift(workout);
                }
                
                this.saveUserData();
                this.updateUI();
                this.closeWorkoutModal();
                this.showToast('Workout Saved', `${workout.name} has been ${editIndex >= 0 ? 'updated' : 'added'}`);
            }
            
            editWorkout(index) {
                const workout = this.userData.workouts[index];
                document.getElementById('workoutModalTitle').textContent = 'Edit Workout';
                document.getElementById('workoutSubmitBtn').textContent = 'Save Changes';
                document.getElementById('editWorkoutIndex').value = index;
                document.getElementById('workoutName').value = workout.name;
                document.getElementById('workoutDuration').value = workout.duration;
                document.getElementById('workoutCalories').value = workout.calories;
                document.getElementById('workoutModal').classList.add('show');
            }
            
            deleteWorkout(index) {
                if (confirm('Are you sure you want to delete this workout?')) {
                    const workoutName = this.userData.workouts[index].name;
                    this.userData.workouts.splice(index, 1);
                    this.saveUserData();
                    this.updateUI();
                    this.showToast('Workout Deleted', `${workoutName} has been removed`);
                }
            }
            
            updateProgressStats() {
                const weightChange = this.userData.initialWeight - this.userData.weight;
                const workoutCount = this.userData.workouts.length;
                
                // Calculate streak (simplified - using consecutive days with workouts)
                const streak = this.calculateStreak();
                
                document.getElementById('currentWeight').textContent = this.userData.weight + ' kg';
                const weightChangeText = weightChange >= 0 ? '-' : '+';
                document.getElementById('weightChangeBadge').textContent = weightChangeText + Math.abs(weightChange).toFixed(1) + 'kg';
                
                // Calculate goal weight based on goal type
                let goalWeight = this.userData.weight;
                if (this.userData.goal === 'lose') goalWeight = this.userData.weight - 5;
                if (this.userData.goal === 'muscle') goalWeight = this.userData.weight + 3;
                
                document.getElementById('goalWeight').textContent = goalWeight + ' kg';
                document.getElementById('progressStreak').textContent = streak;
                document.getElementById('progressTotalWorkouts').textContent = workoutCount;
                
                // Update profile stats
                document.getElementById('totalWorkouts').textContent = workoutCount;
                document.getElementById('dayStreak').textContent = streak;
                document.getElementById('weightLost').textContent = weightChangeText + Math.abs(weightChange).toFixed(1) + 'kg';
            }
            
            calculateStreak() {
                if (this.userData.workouts.length === 0) return 0;
                
                let streak = 0;
                const today = new Date();
                today.setHours(0, 0, 0, 0);
                
                // Check if there's a workout today
                const hasTodayWorkout = this.userData.workouts.some(w => {
                    const workoutDate = new Date(w.date);
                    workoutDate.setHours(0, 0, 0, 0);
                    return workoutDate.getTime() === today.getTime();
                });
                
                if (!hasTodayWorkout) return 0;
                
                streak = 1;
                
                // Check consecutive days backwards
                for (let i = 1; i <= 30; i++) {
                    const checkDate = new Date(today);
                    checkDate.setDate(checkDate.getDate() - i);
                    
                    const hasWorkoutOnDay = this.userData.workouts.some(w => {
                        const workoutDate = new Date(w.date);
                        workoutDate.setHours(0, 0, 0, 0);
                        return workoutDate.getTime() === checkDate.getTime();
                    });
                    
                    if (hasWorkoutOnDay) {
                        streak++;
                    } else {
                        break;
                    }
                }
                
                return streak;
            }
            
            saveProfile() {
                this.userData.name = document.getElementById('profileNameInput').value;
                this.userData.email = document.getElementById('profileEmailInput').value;
                this.userData.age = parseInt(document.getElementById('profileAgeInput').value);
                this.userData.weight = parseInt(document.getElementById('profileWeightInput').value);
                this.userData.height = parseInt(document.getElementById('profileHeightInput').value);
                this.userData.activityLevel = document.getElementById('profileActivityInput').value;
                
                if (!this.userData.initialWeight) {
                    this.userData.initialWeight = this.userData.weight;
                }
                
                this.saveUserData();
                this.updateUI();
                this.showToast('Profile Updated', 'Your profile has been saved successfully');
            }
            
            loadProfileData() {
                document.getElementById('profileNameInput').value = this.userData.name;
                document.getElementById('profileEmailInput').value = this.userData.email;
                document.getElementById('profileAgeInput').value = this.userData.age;
                document.getElementById('profileWeightInput').value = this.userData.weight;
                document.getElementById('profileHeightInput').value = this.userData.height;
                document.getElementById('profileActivityInput').value = this.userData.activityLevel;
            }
            
            initCharts() {
                this.initActivityChart();
                this.initWeightChart();
                
                // Chart tab switching
                document.querySelectorAll('.chart-tab').forEach(tab => {
                    tab.addEventListener('click', (e) => {
                        const tabs = e.target.parentElement.querySelectorAll('.chart-tab');
                        tabs.forEach(t => t.classList.remove('active'));
                        e.target.classList.add('active');
                    });
                });
            }
            
            initActivityChart() {
                const container = document.getElementById('activityChart');
                const days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
                const values = [65, 80, 45, 90, 70, 85, 60];
                
                container.innerHTML = '';
                days.forEach((day, index) => {
                    const wrapper = document.createElement('div');
                    wrapper.className = 'chart-bar-wrapper';
                    
                    const bar = document.createElement('div');
                    bar.className = 'chart-bar';
                    bar.style.height = `${values[index]}%`;
                    
                    const label = document.createElement('span');
                    label.className = 'chart-label';
                    label.textContent = day;
                    
                    wrapper.appendChild(bar);
                    wrapper.appendChild(label);
                    container.appendChild(wrapper);
                });
                
                const style = document.createElement('style');
                style.textContent = days.map((_, i) => 
                    `.chart-bar-wrapper:nth-child(${i + 1}) .chart-bar::after { height: ${values[i]}%; }`
                ).join('');
                document.head.appendChild(style);
            }
            
            initWeightChart() {
                const container = document.getElementById('weightChart');
                const months = ['Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'Mar'];
                const startWeight = this.userData.initialWeight || this.userData.weight;
                const currentWeight = this.userData.weight;
                const weightDiff = startWeight - currentWeight;
                const monthlyChange = weightDiff / 6;
                
                const weights = [];
                for (let i = 0; i < 6; i++) {
                    weights.push(startWeight - (monthlyChange * i));
                }
                
                const maxWeight = Math.max(...weights);
                const minWeight = Math.min(...weights) - 2;
                const range = maxWeight - minWeight;
                
                container.innerHTML = '';
                months.forEach((month, index) => {
                    const wrapper = document.createElement('div');
                    wrapper.className = 'chart-bar-wrapper';
                    
                    const heightPercent = ((weights[index] - minWeight) / range) * 100;
                    
                    const bar = document.createElement('div');
                    bar.className = 'chart-bar';
                    bar.style.height = `${heightPercent}%`;
                    
                    const label = document.createElement('span');
                    label.className = 'chart-label';
                    label.textContent = month;
                    
                    wrapper.appendChild(bar);
                    wrapper.appendChild(label);
                    container.appendChild(wrapper);
                });
                
                const style = document.createElement('style');
                style.textContent = months.map((_, i) => {
                    const heightPercent = ((weights[i] - minWeight) / range) * 100;
                    return `#weightChart .chart-bar-wrapper:nth-child(${i + 1}) .chart-bar::after { height: ${heightPercent}%; }`;
                }).join('');
                document.head.appendChild(style);
            }
            
            showToast(title, message, type = 'success') {
                const toast = document.getElementById('toast');
                const toastIcon = document.getElementById('toastIcon');
                const toastTitle = document.getElementById('toastTitle');
                const toastMessage = document.getElementById('toastMessage');
                
                toastTitle.textContent = title;
                toastMessage.textContent = message;
                
                // Update icon based on type
                toastIcon.className = 'toast-icon ' + type;
                toastIcon.innerHTML = type === 'success' ? 
                    '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 16px; height: 16px;"><path d="M20 6L9 17l-5-5"/></svg>' :
                    '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 16px; height: 16px;"><path d="M12 8v4"/><path d="M12 16h.01"/><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/></svg>';
                
                toast.classList.add('show');
                
                // Auto-hide after 5 seconds
                setTimeout(() => {
                    toast.classList.remove('show');
                }, 5000);
            }
            
            hideToast() {
                document.getElementById('toast').classList.remove('show');
            }
        }
        
        // Initialize dashboard
        const dashboard = new FitLifeDashboard();
        
        // Global functions for onclick handlers
        window.addWaterGlass = () => dashboard.addWaterGlass();
        window.resetWater = () => dashboard.resetWater();
        window.openCalorieModal = () => dashboard.openCalorieModal();
        window.closeCalorieModal = () => dashboard.closeCalorieModal();
        window.addCalories = (e) => dashboard.addCalories(e);
        window.resetCalories = () => dashboard.resetCalories();
        window.openWorkoutModal = () => dashboard.openWorkoutModal();
        window.closeWorkoutModal = () => dashboard.closeWorkoutModal();
        window.saveWorkout = (e) => dashboard.saveWorkout(e);
        window.editWorkout = (index) => dashboard.editWorkout(index);
        window.deleteWorkout = (index) => dashboard.deleteWorkout(index);
        window.loadProfileData = () => dashboard.loadProfileData();
        window.hideToast = () => dashboard.hideToast();
        
        // Close modals when clicking outside
        document.getElementById('calorieModal')?.addEventListener('click', (e) => {
            if (e.target.id === 'calorieModal') dashboard.closeCalorieModal();
        });
        document.getElementById('workoutModal')?.addEventListener('click', (e) => {
            if (e.target.id === 'workoutModal') dashboard.closeWorkoutModal();
        });
    </script>
</body>
</html>