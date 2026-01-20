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

        .meals-card {
            background: var(--card-bg);
            border-radius: 16px;
            padding: 24px;
            border: 1px solid var(--border);
            margin-top: 24px;
        }

        .meals-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }

        .meals-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-primary);
        }

        .meals-config {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .meals-config label {
            font-size: 14px;
            color: var(--text-secondary);
        }

        .meals-config input {
            width: 80px;
            padding: 8px 10px;
            border-radius: 8px;
            border: 1px solid var(--border);
            background: var(--bg-primary);
            color: var(--text-primary);
        }

        .meals-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .meal-item {
            border-radius: 12px;
            border: 1px solid var(--border);
            padding: 16px;
        }

        .meal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .meal-name {
            font-size: 15px;
            font-weight: 600;
            color: var(--text-primary);
        }

        .meal-calories {
            font-size: 14px;
            font-weight: 600;
            color: var(--accent);
        }

        .meal-add-row {
            display: grid;
            grid-template-columns: minmax(180px, 2fr) 90px 110px;
            gap: 8px;
            margin-bottom: 10px;
        }

        .meal-add-row .form-input,
        .meal-add-row .form-select {
            padding: 8px 10px;
            font-size: 13px;
            border-radius: 8px;
        }

        .meal-add-row .btn {
            padding: 8px 12px;
            font-size: 13px;
        }

        .food-results {
            margin-top: 6px;
            border-radius: 8px;
            border: 1px solid var(--border);
            background: var(--bg-primary);
            max-height: 180px;
            overflow-y: auto;
            box-shadow: 0 4px 12px var(--shadow);
        }

        .food-result-item {
            padding: 8px 10px;
            font-size: 13px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .food-result-item span {
            color: var(--text-secondary);
        }

        .food-result-item strong {
            color: var(--text-primary);
        }

        .food-result-item:hover {
            background: var(--accent-light);
        }

        .meal-foods-list {
            border-top: 1px solid var(--border);
            padding-top: 10px;
        }

        .meal-food-row {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr auto;
            gap: 8px;
            align-items: center;
            font-size: 13px;
            padding: 4px 0;
            color: var(--text-secondary);
        }

        .meal-food-row strong {
            color: var(--text-primary);
        }

        .meal-food-row button {
            padding: 4px 8px;
            font-size: 12px;
            border-radius: 8px;
        }

        @media (max-width: 768px) {
            .meal-add-row {
                grid-template-columns: 1fr 1fr;
                grid-template-rows: auto auto auto;
            }
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
                            <div class="card-label">Calories Consumed</div>
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
                                        <path d="M8 2v4"/>
                                        <path d="M16 2v4"/>
                                        <rect x="3" y="4" width="18" height="18" rx="2"/>
                                        <path d="M3 10h18"/>
                                    </svg>
                                </div>
                                <span class="card-badge up" id="mealsBadge">0</span>
                            </div>
                            <div class="card-value" id="dashboardMeals">0</div>
                            <div class="card-label">Meals Today</div>
                            <div class="card-progress">
                                <div class="progress-bar">
                                    <div class="progress-fill blue" id="mealsProgress" style="width: 0%"></div>
                                </div>
                                <div class="progress-text">
                                    <span id="mealsCount">0 meals</span>
                                    <span id="mealsGoalDisplay">3 / day</span>
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
                                        <path d="M12 2L2 7l10 5 10-5-10-5Z"/>
                                        <path d="m2 17 10 5 10-5"/>
                                        <path d="m2 12 10 5 10-5"/>
                                    </svg>
                                </div>
                                <span class="card-badge down" id="workoutsBadge">0</span>
                            </div>
                            <div class="card-value" id="dashboardWorkouts">0</div>
                            <div class="card-label">Total Workouts</div>
                            <div class="card-progress">
                                <div class="progress-bar">
                                    <div class="progress-fill green" id="workoutsProgress" style="width: 0%"></div>
                                </div>
                                <div class="progress-text">
                                    <span id="workoutsCount">0 workouts</span>
                                    <span id="workoutsGoalDisplay">7 / week</span>
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
                        <p class="section-subtitle">Track your daily calorie intake</p>
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
                        <p style="margin-top: 12px; font-size: 13px; color: var(--text-muted);">
                            Calories are automatically calculated from the foods you add to your meals below.
                        </p>
                    </div>

                    <!-- Meals & Foods -->
                    <div class="meals-card">
                        <div class="meals-header">
                            <div class="meals-title">Meals & Foods</div>
                            <div class="meals-config">
                                <label for="mealsPerDayInput">Meals per day:</label>
                                <input type="number" id="mealsPerDayInput" min="1" max="10" value="3">
                                <button class="btn btn-secondary" type="button" onclick="applyMealsPerDay()">Apply</button>
                            </div>
                        </div>
                        <div class="meals-list" id="mealsContainer"></div>
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
        // Initialize user data from localStorage or URL parameters
        let userData = {
            name: '',
            email: '',
            age: '',
            height: '',
            weight: '',
            goal: '',
            frequency: 3,
            duration: 45,
            activities: '',
            calorieGoal: 2000,
            caloriesConsumed: 0,
            activeMinutes: 0,
            workouts: [],
            initialWeight: 0,
            mealsPerDay: 3,
            meals: [] // { name, foods: [{ name, quantity, unit, calories }] }
        };

        const FOOD_DB = [
            { name: 'Apple', caloriesPer100g: 52 },
            { name: 'Banana', caloriesPer100g: 96 },
            { name: 'Chicken Breast (grilled)', caloriesPer100g: 165 },
            { name: 'Rice (cooked)', caloriesPer100g: 130 },
            { name: 'Egg (boiled)', caloriesPer100g: 155 },
            { name: 'Oats', caloriesPer100g: 389 },
            { name: 'Greek Yogurt', caloriesPer100g: 59 },
            { name: 'Almonds', caloriesPer100g: 579 },
            { name: 'Broccoli (boiled)', caloriesPer100g: 35 },
            { name: 'Salmon (grilled)', caloriesPer100g: 208 }
        ];

        // Load data from URL parameters (from index.php)
        function loadFromURLParams() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('name')) {
                userData.name = urlParams.get('name') || 'User';
                userData.email = urlParams.get('email') || '';
                userData.age = parseInt(urlParams.get('age')) || 25;
                userData.height = parseInt(urlParams.get('height')) || 175;
                userData.weight = parseInt(urlParams.get('weight')) || 70;
                userData.initialWeight = userData.weight;
                userData.goal = urlParams.get('goal') || 'maintain';
                userData.frequency = parseInt(urlParams.get('frequency')) || 3;
                userData.duration = parseInt(urlParams.get('duration')) || 45;
                userData.activities = urlParams.get('activities') || '';
                
                // Save to localStorage
                saveUserData();
            }
        }

        // Load data from localStorage
        function loadUserData() {
            const saved = localStorage.getItem('fitLifeUserData');
            if (saved) {
                userData = { ...userData, ...JSON.parse(saved) };
            }
        }

        // Save data to localStorage
        function saveUserData() {
            localStorage.setItem('fitLifeUserData', JSON.stringify(userData));
        }

        // Initialize on page load
        loadFromURLParams();
        loadUserData();

        // Update UI with user data
        function updateUI() {
            // Update user info in sidebar and header
            const initials = userData.name ? userData.name.split(' ').map(n => n[0]).join('').toUpperCase() : 'U';
            document.getElementById('sidebarAvatar').textContent = initials;
            document.getElementById('sidebarUserName').textContent = userData.name || 'User';
            document.getElementById('sidebarUserEmail').textContent = userData.email || 'user@email.com';
            document.getElementById('profileAvatar').textContent = initials;
            document.getElementById('profileName').textContent = userData.name || 'User';
            
            // Update greeting
            const hour = new Date().getHours();
            let greeting = 'Good Morning';
            if (hour >= 12 && hour < 17) greeting = 'Good Afternoon';
            if (hour >= 17) greeting = 'Good Evening';
            document.getElementById('greeting').textContent = `${greeting}, ${userData.name.split(' ')[0] || 'User'}`;
            
            // Update dashboard stats
            updateDashboardStats();
            updateNutritionStats();
            renderMealsUI();
            updateWorkoutStats();
            updateProgressStats();
            
            // Update profile form
            loadProfileData();
        }

        // Update dashboard statistics
        function updateDashboardStats() {
            const totalCaloriesConsumed = getTotalMealCalories();
            const calorieGoal = userData.calorieGoal || 2000;
            const caloriePercent = Math.min((totalCaloriesConsumed / calorieGoal) * 100, 100);
            
            const activeGoal = 60;
            const activePercent = Math.min((userData.activeMinutes / activeGoal) * 100, 100);
            
            // Update header quick stats
            document.getElementById('headerCalories').textContent = totalCaloriesConsumed.toLocaleString();
            
            // Update dashboard cards
            document.getElementById('dashboardCalories').textContent = totalCaloriesConsumed.toLocaleString();
            document.getElementById('caloriesProgress').style.width = caloriePercent + '%';
            document.getElementById('caloriesPercent').textContent = Math.round(caloriePercent) + '% of goal';
            document.getElementById('caloriesGoal').textContent = calorieGoal + ' cal';
            document.getElementById('caloriesBadge').textContent = '+' + Math.round(caloriePercent) + '%';
            
            document.getElementById('dashboardActiveTime').textContent = userData.activeMinutes + ' min';
            document.getElementById('activeProgress').style.width = activePercent + '%';
            document.getElementById('activePercent').textContent = Math.round(activePercent) + '% of goal';
            document.getElementById('activeBadge').textContent = '+' + Math.round(activePercent) + '%';

            const workoutsCount = userData.workouts.length;
            const weeklyWorkoutsGoal = 7;
            const workoutsPercent = Math.min((workoutsCount / weeklyWorkoutsGoal) * 100, 100);

            document.getElementById('dashboardWorkouts').textContent = workoutsCount.toLocaleString();
            document.getElementById('workoutsProgress').style.width = workoutsPercent + '%';
            document.getElementById('workoutsCount').textContent = workoutsCount + ' workouts';
            document.getElementById('workoutsGoalDisplay').textContent = weeklyWorkoutsGoal + ' / week';
            document.getElementById('workoutsBadge').textContent = workoutsCount.toLocaleString();

            // Meals summary
            const mealsCount = (userData.meals || []).filter(m => (m.foods || []).length > 0).length;
            const mealsGoal = userData.mealsPerDay || 3;
            const mealsPercent = Math.min((mealsCount / mealsGoal) * 100, 100);

            document.getElementById('dashboardMeals').textContent = mealsCount.toString();
            document.getElementById('mealsProgress').style.width = mealsPercent + '%';
            document.getElementById('mealsCount').textContent = mealsCount + ' meals';
            document.getElementById('mealsGoalDisplay').textContent = mealsGoal + ' / day';
            document.getElementById('mealsBadge').textContent = mealsCount.toString();
        }

        // Compute total calories from all meals
        function getTotalMealCalories() {
            return (userData.meals || []).reduce((sum, meal) => {
                const mealCals = (meal.foods || []).reduce((msum, f) => msum + (f.calories || 0), 0);
                return sum + mealCals;
            }, 0);
        }

        // Update nutrition statistics
        function updateNutritionStats() {
            const goal = userData.calorieGoal;
            const consumedFromMeals = getTotalMealCalories();

            // Keep caloriesConsumed in sync with meals so the graphic always reflects logged foods
            userData.caloriesConsumed = consumedFromMeals;

            const consumed = userData.caloriesConsumed;
            const remaining = Math.max(goal - consumed, 0);
            const percent = Math.min((consumed / goal) * 100, 100);
            
            document.getElementById('calorieGoalInput').value = goal;
            document.getElementById('caloriesConsumed').textContent = consumed.toLocaleString();
            document.getElementById('calorieGoalText').textContent = goal.toLocaleString();
            document.getElementById('caloriesRemaining').textContent = remaining.toLocaleString();
            document.getElementById('nutritionProgress').style.width = percent + '%';
        }

        // Meals & foods
        function ensureMealsInitialized() {
            if (!Array.isArray(userData.meals)) {
                userData.meals = [];
            }
            const namesPreset = ['Breakfast', 'Lunch', 'Dinner', 'Snack 1', 'Snack 2', 'Snack 3'];
            while (userData.meals.length < (userData.mealsPerDay || 3)) {
                const index = userData.meals.length;
                userData.meals.push({
                    name: namesPreset[index] || `Meal ${index + 1}`,
                    foods: []
                });
            }
            if (userData.meals.length > userData.mealsPerDay) {
                userData.meals = userData.meals.slice(0, userData.mealsPerDay);
            }
        }

        function applyMealsPerDay() {
            const input = document.getElementById('mealsPerDayInput');
            const value = parseInt(input.value) || 3;
            userData.mealsPerDay = Math.min(Math.max(value, 1), 10);
            ensureMealsInitialized();
            saveUserData();
            renderMealsUI();
            updateDashboardStats();
        }

        function renderMealsUI() {
            const container = document.getElementById('mealsContainer');
            if (!container) return;

            document.getElementById('mealsPerDayInput').value = userData.mealsPerDay || 3;
            ensureMealsInitialized();

            container.innerHTML = userData.meals.map((meal, index) => {
                const mealCalories = (meal.foods || []).reduce((sum, f) => sum + (f.calories || 0), 0);
                return `
                    <div class="meal-item">
                        <div class="meal-header">
                            <div class="meal-name">${meal.name || 'Meal ' + (index + 1)}</div>
                            <div class="meal-calories"><span id="mealCalories-${index}">${mealCalories.toFixed(0)}</span> cal</div>
                        </div>
                        <div class="meal-add-row">
                            <div>
                                <input type="text" class="form-input" id="foodSearch-${index}" placeholder="Search food..." oninput="updateFoodSuggestions(${index})">
                                <div class="food-results" id="foodResults-${index}"></div>
                            </div>
                            <input type="number" class="form-input" id="foodQuantity-${index}" placeholder="Qty (g)" min="1" value="100">
                            <button class="btn btn-secondary" type="button" onclick="addFoodToMeal(${index})">Add</button>
                        </div>
                        <div class="meal-foods-list" id="mealFoods-${index}">
                            ${renderMealFoodsHTML(index)}
                        </div>
                    </div>
                `;
            }).join('');
        }

        function updateFoodSuggestions(mealIndex) {
            const searchInput = document.getElementById(`foodSearch-${mealIndex}`);
            const resultsContainer = document.getElementById(`foodResults-${mealIndex}`);
            if (!searchInput || !resultsContainer) return;

            const term = searchInput.value.toLowerCase().trim();
            if (!term) {
                resultsContainer.innerHTML = '';
                return;
            }

            const matches = FOOD_DB.filter(f => f.name.toLowerCase().includes(term)).slice(0, 20);

            if (matches.length === 0) {
                resultsContainer.innerHTML = '<div class="food-result-item"><span>No foods found</span></div>';
                return;
            }

            resultsContainer.innerHTML = matches.map(food => `
                <div class="food-result-item" onclick="selectFoodForMeal(${mealIndex}, '${food.name.replace(/'/g, "\\'")}', ${food.caloriesPer100g})">
                    <strong>${food.name}</strong>
                    <span>${food.caloriesPer100g} cal / 100g</span>
                </div>
            `).join('');
        }

        function selectFoodForMeal(mealIndex, foodName, caloriesPer100g) {
            const searchInput = document.getElementById(`foodSearch-${mealIndex}`);
            const resultsContainer = document.getElementById(`foodResults-${mealIndex}`);
            if (!searchInput) return;

            searchInput.value = foodName;
            searchInput.dataset.selectedFood = foodName;
            if (resultsContainer) resultsContainer.innerHTML = '';
        }

        function addFoodToMeal(mealIndex) {
            ensureMealsInitialized();
            const searchInput = document.getElementById(`foodSearch-${mealIndex}`);
            const qtyInput = document.getElementById(`foodQuantity-${mealIndex}`);
            if (!searchInput || !qtyInput) return;

            const foodName = searchInput.dataset.selectedFood || searchInput.value;
            const quantity = parseFloat(qtyInput.value) || 0;
            if (!foodName || quantity <= 0) return;

            const base = FOOD_DB.find(f => f.name === foodName);
            const caloriesPer100g = base ? base.caloriesPer100g : 0;
            const calories = caloriesPer100g * (quantity / 100);

            userData.meals[mealIndex].foods.push({
                name: foodName,
                quantity,
                unit: 'g',
                calories
            });

            saveUserData();
            renderMealsUI();
            updateDashboardStats();
        }

        function removeFoodFromMeal(mealIndex, foodIndex) {
            if (!userData.meals || !userData.meals[mealIndex]) return;
            userData.meals[mealIndex].foods.splice(foodIndex, 1);
            saveUserData();
            renderMealsUI();
            updateDashboardStats();
        }

        function renderMealFoodsHTML(mealIndex) {
            const meal = (userData.meals || [])[mealIndex];
            if (!meal || !Array.isArray(meal.foods) || meal.foods.length === 0) {
                return '<p style="font-size: 13px; color: var(--text-muted);">No foods added yet for this meal.</p>';
            }

            return meal.foods.map((food, idx) => `
                <div class="meal-food-row">
                    <div><strong>${food.name}</strong></div>
                    <div>${food.quantity} ${food.unit}</div>
                    <div>${food.calories.toFixed(0)} cal</div>
                    <div><button type="button" class="btn btn-secondary" onclick="removeFoodFromMeal(${mealIndex}, ${idx})">Remove</button></div>
                </div>
            `).join('');
        }

        // Update calorie goal
        document.getElementById('calorieGoalInput').addEventListener('change', function() {
            userData.calorieGoal = parseInt(this.value) || 2000;
            saveUserData();
            updateUI();
        });

        // Update workout statistics
        function updateWorkoutStats() {
            const now = new Date();
            const weekAgo = new Date(now.getTime() - 7 * 24 * 60 * 60 * 1000);
            
            const weekWorkouts = userData.workouts.filter(w => {
                const workoutDate = new Date(w.date);
                return workoutDate >= weekAgo;
            }).length;
            
            const totalDuration = userData.workouts.reduce((sum, w) => sum + (w.duration || 0), 0);
            const totalCalories = userData.workouts.reduce((sum, w) => sum + (w.calories || 0), 0);
            
            document.getElementById('weekWorkouts').textContent = weekWorkouts;
            document.getElementById('totalDuration').textContent = (totalDuration / 60).toFixed(1) + 'h';
            document.getElementById('totalCaloriesBurned').textContent = totalCalories.toLocaleString();
            
            // Update active minutes from workouts
            userData.activeMinutes = userData.workouts
                .filter(w => {
                    const workoutDate = new Date(w.date);
                    const today = new Date();
                    return workoutDate.toDateString() === today.toDateString();
                })
                .reduce((sum, w) => sum + (w.duration || 0), 0);
            
            renderWorkoutList();
        }

        // Render workout list
        function renderWorkoutList() {
            const container = document.getElementById('workoutList');
            
            if (userData.workouts.length === 0) {
                container.innerHTML = '<div class="card"><p style="text-align: center; color: var(--text-muted); padding: 40px 20px;">No workouts yet. Click "Add Workout" to get started!</p></div>';
                return;
            }
            
            container.innerHTML = userData.workouts.map((workout, index) => {
                const date = new Date(workout.date);
                const timeAgo = getTimeAgo(date);
                
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
                            <button class="workout-action-btn" onclick="editWorkout(${index})">Edit</button>
                            <button class="workout-action-btn delete" onclick="deleteWorkout(${index})">Delete</button>
                        </div>
                    </div>
                `;
            }).join('');
        }

        // Get time ago string
        function getTimeAgo(date) {
            const now = new Date();
            const diffMs = now - date;
            const diffMins = Math.floor(diffMs / 60000);
            const diffHours = Math.floor(diffMs / 3600000);
            const diffDays = Math.floor(diffMs / 86400000);
            
            if (diffMins < 60) return diffMins + ' minutes ago';
            if (diffHours < 24) return diffHours + ' hours ago';
            if (diffDays === 0) return 'Today';
            if (diffDays === 1) return 'Yesterday';
            if (diffDays < 7) return diffDays + ' days ago';
            return date.toLocaleDateString();
        }

        // Open workout modal
        function openWorkoutModal() {
            document.getElementById('workoutModalTitle').textContent = 'Add Workout';
            document.getElementById('workoutSubmitBtn').textContent = 'Add Workout';
            document.getElementById('editWorkoutIndex').value = '-1';
            document.getElementById('workoutForm').reset();
            document.getElementById('workoutModal').classList.add('show');
        }

        // Close workout modal
        function closeWorkoutModal() {
            document.getElementById('workoutModal').classList.remove('show');
        }

        // Save workout
        function saveWorkout(event) {
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
                userData.workouts[editIndex] = workout;
            } else {
                userData.workouts.unshift(workout);
            }
            
            saveUserData();
            updateUI();
            closeWorkoutModal();
        }

        // Edit workout
        function editWorkout(index) {
            const workout = userData.workouts[index];
            document.getElementById('workoutModalTitle').textContent = 'Edit Workout';
            document.getElementById('workoutSubmitBtn').textContent = 'Save Changes';
            document.getElementById('editWorkoutIndex').value = index;
            document.getElementById('workoutName').value = workout.name;
            document.getElementById('workoutDuration').value = workout.duration;
            document.getElementById('workoutCalories').value = workout.calories;
            document.getElementById('workoutModal').classList.add('show');
        }

        // Delete workout
        function deleteWorkout(index) {
            if (confirm('Are you sure you want to delete this workout?')) {
                userData.workouts.splice(index, 1);
                saveUserData();
                updateUI();
            }
        }

        // Update progress statistics
        function updateProgressStats() {
            const weightChange = userData.initialWeight - userData.weight;
            const workoutCount = userData.workouts.length;
            
            // Calculate streak (simplified - just using workout count for now)
            const streak = Math.min(workoutCount, 30);
            
            document.getElementById('currentWeight').textContent = userData.weight + ' kg';
            document.getElementById('weightChangeBadge').textContent = (weightChange >= 0 ? '-' : '+') + Math.abs(weightChange).toFixed(1) + 'kg';
            
            // Calculate goal weight based on goal type
            let goalWeight = userData.weight;
            if (userData.goal === 'lose') goalWeight = userData.weight - 5;
            if (userData.goal === 'muscle') goalWeight = userData.weight + 3;
            
            document.getElementById('goalWeight').textContent = goalWeight + ' kg';
            document.getElementById('progressStreak').textContent = streak;
            document.getElementById('progressTotalWorkouts').textContent = workoutCount;
            
            // Update profile stats
            document.getElementById('totalWorkouts').textContent = workoutCount;
            document.getElementById('dayStreak').textContent = streak;
            document.getElementById('weightLost').textContent = (weightChange >= 0 ? '-' : '+') + Math.abs(weightChange).toFixed(1) + 'kg';
        }

        // Load profile data into form
        function loadProfileData() {
            document.getElementById('profileNameInput').value = userData.name || '';
            document.getElementById('profileEmailInput').value = userData.email || '';
            document.getElementById('profileAgeInput').value = userData.age || '';
            document.getElementById('profileWeightInput').value = userData.weight || '';
            document.getElementById('profileHeightInput').value = userData.height || '';
            document.getElementById('profileActivityInput').value = userData.activityLevel || 'moderate';
        }

        // Handle profile form submission
        document.getElementById('profileForm').addEventListener('submit', function(event) {
            event.preventDefault();
            
            userData.name = document.getElementById('profileNameInput').value;
            userData.email = document.getElementById('profileEmailInput').value;
            userData.age = parseInt(document.getElementById('profileAgeInput').value);
            userData.weight = parseInt(document.getElementById('profileWeightInput').value);
            userData.height = parseInt(document.getElementById('profileHeightInput').value);
            userData.activityLevel = document.getElementById('profileActivityInput').value;
            
            if (!userData.initialWeight) {
                userData.initialWeight = userData.weight;
            }
            
            saveUserData();
            updateUI();
            alert('Profile updated successfully!');
        });

        // Navigation
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const menuToggle = document.getElementById('menuToggle');
        const themeToggle = document.getElementById('themeToggle');
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

        themeToggle.addEventListener('click', () => {
            themeToggle.classList.toggle('active');
            document.body.setAttribute('data-theme', 
                themeToggle.classList.contains('active') ? 'dark' : 'light'
            );
            localStorage.setItem('theme', themeToggle.classList.contains('active') ? 'dark' : 'light');
        });

        // Load saved theme
        if (localStorage.getItem('theme') === 'dark') {
            themeToggle.classList.add('active');
            document.body.setAttribute('data-theme', 'dark');
        }

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

        // Set current date
        const dateElement = document.getElementById('currentDate');
        const now = new Date();
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        dateElement.textContent = now.toLocaleDateString('en-US', options);

        // Initialize activity chart
        function initActivityChart() {
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

        // Initialize weight chart
        function initWeightChart() {
            const container = document.getElementById('weightChart');
            const months = ['Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'Mar'];
            const startWeight = userData.initialWeight || userData.weight;
            const currentWeight = userData.weight;
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

        // Initialize charts
        initActivityChart();
        initWeightChart();

        // Chart tab switching
        document.querySelectorAll('.chart-tab').forEach(tab => {
            tab.addEventListener('click', (e) => {
                const tabs = e.target.parentElement.querySelectorAll('.chart-tab');
                tabs.forEach(t => t.classList.remove('active'));
                e.target.classList.add('active');
            });
        });

        // Close modals when clicking outside
        document.getElementById('calorieModal')?.addEventListener('click', (e) => {
            if (e.target.id === 'calorieModal') closeCalorieModal();
        });
        document.getElementById('workoutModal')?.addEventListener('click', (e) => {
            if (e.target.id === 'workoutModal') closeWorkoutModal();
        });

        // Initialize UI
        updateUI();
    </script>
</body>
</html>