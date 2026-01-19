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

        /* Activity Chart */
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

        .profile-avatar {
            width: 100px;
            height: 100px;
            border-radius: 20px;
            object-fit: cover;
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

        .form-input {
            padding: 12px 16px;
            border: 1px solid var(--border);
            border-radius: 10px;
            font-size: 14px;
            background: var(--bg-primary);
            color: var(--text-primary);
            transition: border-color 0.2s ease;
        }

        .form-input:focus {
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
        }

        .btn-secondary {
            background: var(--bg-primary);
            color: var(--text-secondary);
        }

        .btn-secondary:hover {
            background: var(--border);
        }

        /* Nutrition Section */
        .nutrition-setup {
            background: var(--card-bg);
            border-radius: 16px;
            padding: 24px;
            border: 1px solid var(--border);
            margin-bottom: 24px;
        }

        .nutrition-setup-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .nutrition-setup-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-primary);
        }

        .setup-form {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .setup-form label {
            font-size: 14px;
            color: var(--text-secondary);
        }

        .setup-form select {
            padding: 10px 16px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: var(--bg-primary);
            color: var(--text-primary);
            font-size: 14px;
            cursor: pointer;
        }

        .setup-form select:focus {
            outline: none;
            border-color: var(--accent);
        }

        .calorie-goal-container {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .calorie-goal-container input {
            width: 100px;
            padding: 10px 12px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: var(--bg-primary);
            color: var(--text-primary);
            font-size: 14px;
        }

        .calorie-goal-container input:focus {
            outline: none;
            border-color: var(--accent);
        }

        .daily-summary {
            background: var(--card-bg);
            border-radius: 16px;
            padding: 24px;
            border: 1px solid var(--border);
            margin-bottom: 24px;
        }

        .daily-summary-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .daily-summary-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-primary);
        }

        .daily-total-calories {
            font-size: 28px;
            font-weight: 700;
            color: var(--accent);
        }

        .daily-total-calories span {
            font-size: 14px;
            font-weight: 400;
            color: var(--text-muted);
        }

        .calorie-progress {
            margin-top: 16px;
        }

        .calorie-progress-bar {
            height: 12px;
            background: var(--bg-primary);
            border-radius: 6px;
            overflow: hidden;
        }

        .calorie-progress-fill {
            height: 100%;
            border-radius: 6px;
            background: var(--accent);
            transition: width 0.5s ease, background 0.3s ease;
        }

        .calorie-progress-fill.warning {
            background: #f59e0b;
        }

        .calorie-progress-fill.danger {
            background: #ef4444;
        }

        .calorie-progress-text {
            display: flex;
            justify-content: space-between;
            margin-top: 8px;
            font-size: 13px;
            color: var(--text-muted);
        }

        .meals-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .meal-card {
            background: var(--card-bg);
            border-radius: 16px;
            padding: 24px;
            border: 1px solid var(--border);
            transition: box-shadow 0.2s ease;
        }

        .meal-card:hover {
            box-shadow: 0 4px 20px var(--shadow);
        }

        .meal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--border);
        }

        .meal-header-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .meal-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--accent-light);
            color: var(--accent);
        }

        .meal-icon svg {
            width: 22px;
            height: 22px;
        }

        .meal-info {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .meal-title {
            font-size: 16px;
            font-weight: 600;
            color: var(--text-primary);
        }

        .meal-calories {
            font-size: 13px;
            color: var(--text-muted);
        }

        .meal-calories strong {
            color: var(--accent);
            font-weight: 600;
        }

        .add-food-btn {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 10px 16px;
            border: 1px dashed var(--border);
            background: transparent;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 500;
            color: var(--text-secondary);
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .add-food-btn:hover {
            border-color: var(--accent);
            color: var(--accent);
            background: var(--accent-light);
        }

        .add-food-btn svg {
            width: 16px;
            height: 16px;
        }

        .meal-items {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .meal-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 16px;
            background: var(--bg-primary);
            border-radius: 12px;
            animation: fadeInItem 0.3s ease;
        }

        @keyframes fadeInItem {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .meal-item-left {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .meal-item-name {
            font-size: 14px;
            font-weight: 500;
            color: var(--text-primary);
        }

        .meal-item-details {
            font-size: 12px;
            color: var(--text-muted);
        }

        .meal-item-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .meal-item-calories {
            font-size: 14px;
            font-weight: 600;
            color: var(--accent);
        }

        .meal-item-actions {
            display: flex;
            gap: 6px;
        }

        .item-action-btn {
            width: 30px;
            height: 30px;
            border: none;
            background: var(--card-bg);
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            transition: all 0.2s ease;
        }

        .item-action-btn:hover {
            color: var(--text-primary);
        }

        .item-action-btn.delete:hover {
            color: #ef4444;
            background: #fee2e2;
        }

        .item-action-btn svg {
            width: 14px;
            height: 14px;
        }

        .empty-meal {
            padding: 24px;
            text-align: center;
            color: var(--text-muted);
            font-size: 14px;
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

        .modal-form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .modal-form-group label {
            font-size: 13px;
            font-weight: 500;
            color: var(--text-secondary);
        }

        .modal-form-group input {
            padding: 12px 16px;
            border: 1px solid var(--border);
            border-radius: 10px;
            font-size: 14px;
            background: var(--bg-primary);
            color: var(--text-primary);
            transition: border-color 0.2s ease;
        }

        .modal-form-group input:focus {
            outline: none;
            border-color: var(--accent);
        }

        .modal-form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .calorie-preview {
            padding: 16px;
            background: var(--accent-light);
            border-radius: 12px;
            text-align: center;
        }

        .calorie-preview-label {
            font-size: 12px;
            color: var(--text-muted);
            margin-bottom: 4px;
        }

        .calorie-preview-value {
            font-size: 24px;
            font-weight: 700;
            color: var(--accent);
        }

        .modal-actions {
            display: flex;
            gap: 12px;
            margin-top: 8px;
        }

        .modal-actions .btn {
            flex: 1;
        }

        /* Edit modal specific */
        .edit-modal .modal {
            max-width: 420px;
        }

        /* Food Search Styles */
        .search-container {
            position: relative;
        }

        .search-input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .search-icon {
            position: absolute;
            left: 14px;
            width: 18px;
            height: 18px;
            color: var(--text-muted);
            pointer-events: none;
        }

        .search-input-wrapper input {
            width: 100%;
            padding: 12px 40px 12px 42px;
            border: 1px solid var(--border);
            border-radius: 10px;
            font-size: 14px;
            background: var(--bg-primary);
            color: var(--text-primary);
            transition: border-color 0.2s ease;
        }

        .search-input-wrapper input:focus {
            outline: none;
            border-color: var(--accent);
        }

        .clear-search {
            position: absolute;
            right: 10px;
            width: 24px;
            height: 24px;
            border: none;
            background: transparent;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            transition: color 0.2s ease;
        }

        .clear-search:hover {
            color: var(--text-primary);
        }

        .clear-search svg {
            width: 14px;
            height: 14px;
        }

        .search-results {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 10px;
            margin-top: 4px;
            max-height: 240px;
            overflow-y: auto;
            z-index: 100;
            display: none;
            box-shadow: 0 8px 24px var(--shadow);
        }

        .search-results.show {
            display: block;
        }

        .search-result-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 16px;
            cursor: pointer;
            transition: background 0.15s ease;
            border-bottom: 1px solid var(--border);
        }

        .search-result-item:last-child {
            border-bottom: none;
        }

        .search-result-item:hover {
            background: var(--accent-light);
        }

        .search-result-info {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .search-result-name {
            font-size: 14px;
            font-weight: 500;
            color: var(--text-primary);
        }

        .search-result-category {
            font-size: 12px;
            color: var(--text-muted);
        }

        .search-result-calories {
            font-size: 13px;
            font-weight: 600;
            color: var(--accent);
            white-space: nowrap;
        }

        .no-results {
            padding: 16px;
            text-align: center;
            color: var(--text-muted);
            font-size: 14px;
        }

        .selected-food {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 16px;
            background: var(--accent-light);
            border-radius: 10px;
            margin-bottom: 16px;
        }

        .selected-food-info {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .selected-food-name {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-primary);
        }

        .selected-food-calories {
            font-size: 13px;
            color: var(--accent);
        }

        .change-food-btn {
            padding: 6px 12px;
            border: 1px solid var(--border);
            background: var(--card-bg);
            border-radius: 6px;
            font-size: 12px;
            font-weight: 500;
            color: var(--text-secondary);
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .change-food-btn:hover {
            border-color: var(--accent);
            color: var(--accent);
        }

        .btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
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
                    <img src="/public/images/avatar.jpg" alt="User" class="user-avatar">
                    <div class="user-info">
                        <div class="user-name">Alex Johnson</div>
                        <div class="user-email">alex@email.com</div>
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
                    <div class="header-greeting" id="greeting">Good Morning, Alex</div>
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
                            <div class="quick-stat-value">1,847</div>
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
                            <div class="quick-stat-value">8,432</div>
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
                            <div class="quick-stat-value">6/8</div>
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
                                <span class="card-badge up">+12%</span>
                            </div>
                            <div class="card-value">1,847</div>
                            <div class="card-label">Calories Burned</div>
                            <div class="card-progress">
                                <div class="progress-bar">
                                    <div class="progress-fill green" style="width: 73%"></div>
                                </div>
                                <div class="progress-text">
                                    <span>73% of goal</span>
                                    <span>2,500 cal</span>
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
                                <span class="card-badge up">+8%</span>
                            </div>
                            <div class="card-value">8,432</div>
                            <div class="card-label">Steps Today</div>
                            <div class="card-progress">
                                <div class="progress-bar">
                                    <div class="progress-fill blue" style="width: 84%"></div>
                                </div>
                                <div class="progress-text">
                                    <span>84% of goal</span>
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
                                <span class="card-badge up">+5%</span>
                            </div>
                            <div class="card-value">45 min</div>
                            <div class="card-label">Active Time</div>
                            <div class="card-progress">
                                <div class="progress-bar">
                                    <div class="progress-fill orange" style="width: 75%"></div>
                                </div>
                                <div class="progress-text">
                                    <span>75% of goal</span>
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
                                <span class="card-badge down">-2</span>
                            </div>
                            <div class="card-value">6/8</div>
                            <div class="card-label">Water Intake</div>
                            <div class="card-progress">
                                <div class="progress-bar">
                                    <div class="progress-fill green" style="width: 75%"></div>
                                </div>
                                <div class="progress-text">
                                    <span>6 glasses</span>
                                    <span>8 glasses</span>
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
                        <img src="/public/images/avatar.jpg" alt="Profile" class="profile-avatar">
                        <div class="profile-info">
                            <h2>Alex Johnson</h2>
                            <p>Fitness enthusiast since 2022</p>
                            <div class="profile-stats">
                                <div class="profile-stat">
                                    <div class="profile-stat-value">127</div>
                                    <div class="profile-stat-label">Workouts</div>
                                </div>
                                <div class="profile-stat">
                                    <div class="profile-stat-value">14</div>
                                    <div class="profile-stat-label">Day Streak</div>
                                </div>
                                <div class="profile-stat">
                                    <div class="profile-stat-value">5.2kg</div>
                                    <div class="profile-stat-label">Lost</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <h3 style="margin-bottom: 20px; font-size: 18px; color: var(--text-primary);">Personal Information</h3>
                        <div class="form-grid">
                            <div class="form-group">
                                <label class="form-label">Full Name</label>
                                <input type="text" class="form-input" value="Alex Johnson">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-input" value="alex@email.com">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Age</label>
                                <input type="number" class="form-input" value="28">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Weight (kg)</label>
                                <input type="number" class="form-input" value="72">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Height (cm)</label>
                                <input type="number" class="form-input" value="175">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Activity Level</label>
                                <select class="form-input">
                                    <option>Sedentary</option>
                                    <option>Light Activity</option>
                                    <option selected>Moderate Activity</option>
                                    <option>Very Active</option>
                                </select>
                            </div>
                        </div>
                        <div style="margin-top: 24px; display: flex; gap: 12px;">
                            <button class="btn btn-primary">Save Changes</button>
                            <button class="btn btn-secondary">Cancel</button>
                        </div>
                    </div>
                </section>

                <!-- Nutrition Section -->
                <section class="section" id="nutrition">
                    <div class="section-header">
                        <h1 class="section-title">Nutrition</h1>
                        <p class="section-subtitle">Plan your meals and track your daily calories</p>
                    </div>

                    <!-- Meal Setup -->
                    <div class="nutrition-setup">
                        <div class="nutrition-setup-header">
                            <div class="nutrition-setup-title">Meal Planning Setup</div>
                            <div class="setup-form">
                                <label for="mealCount">Number of meals:</label>
                                <select id="mealCount">
                                    <option value="2">2 Meals</option>
                                    <option value="3" selected>3 Meals</option>
                                    <option value="4">4 Meals</option>
                                    <option value="5">5 Meals</option>
                                    <option value="6">6 Meals</option>
                                </select>
                                <div class="calorie-goal-container">
                                    <label for="calorieGoal">Daily Goal:</label>
                                    <input type="number" id="calorieGoal" value="2000" min="500" max="10000">
                                    <span style="color: var(--text-muted); font-size: 14px;">cal</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Daily Summary -->
                    <div class="daily-summary">
                        <div class="daily-summary-header">
                            <div class="daily-summary-title">Daily Summary</div>
                            <div class="daily-total-calories">
                                <span id="totalCaloriesDisplay">0</span> <span>/ <span id="goalDisplay">2000</span> cal</span>
                            </div>
                        </div>
                        <div class="calorie-progress">
                            <div class="calorie-progress-bar">
                                <div class="calorie-progress-fill" id="calorieProgressFill" style="width: 0%"></div>
                            </div>
                            <div class="calorie-progress-text">
                                <span id="percentageDisplay">0% of daily goal</span>
                                <span id="remainingDisplay">2000 cal remaining</span>
                            </div>
                        </div>
                    </div>

                    <!-- Meals Container -->
                    <div class="meals-container" id="mealsContainer">
                        <!-- Meals will be dynamically generated -->
                    </div>
                </section>

                <!-- Add Food Modal -->
                <div class="modal-overlay" id="addFoodModal">
                    <div class="modal">
                        <div class="modal-header">
                            <div class="modal-title">Add Food to <span id="modalMealName">Breakfast</span></div>
                            <button class="modal-close" onclick="closeAddFoodModal()">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M18 6L6 18"/>
                                    <path d="M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                        <form class="modal-form" id="addFoodForm" onsubmit="addFoodItem(event)">
                            <input type="hidden" id="currentMealIndex">
                            <input type="hidden" id="selectedFoodCalories">
                            <div class="modal-form-group">
                                <label for="foodSearch">Search Food</label>
                                <div class="search-container">
                                    <div class="search-input-wrapper">
                                        <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <circle cx="11" cy="11" r="8"/>
                                            <path d="m21 21-4.35-4.35"/>
                                        </svg>
                                        <input type="text" id="foodSearch" placeholder="Search for a food..." autocomplete="off" required>
                                        <button type="button" class="clear-search" id="clearSearch" style="display: none;">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M18 6L6 18"/>
                                                <path d="M6 6l12 12"/>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="search-results" id="searchResults"></div>
                                </div>
                            </div>
                            <div class="selected-food" id="selectedFoodDisplay" style="display: none;">
                                <div class="selected-food-info">
                                    <span class="selected-food-name" id="selectedFoodName"></span>
                                    <span class="selected-food-calories" id="selectedFoodCaloriesDisplay"></span>
                                </div>
                                <button type="button" class="change-food-btn" onclick="clearSelectedFood()">Change</button>
                            </div>
                            <div class="modal-form-group">
                                <label for="foodQuantity">Quantity (servings)</label>
                                <input type="number" id="foodQuantity" min="0.5" step="0.5" value="1" required>
                            </div>
                            <div class="calorie-preview">
                                <div class="calorie-preview-label">Total Calories</div>
                                <div class="calorie-preview-value" id="caloriePreview">0</div>
                            </div>
                            <div class="modal-actions">
                                <button type="button" class="btn btn-secondary" onclick="closeAddFoodModal()">Cancel</button>
                                <button type="submit" class="btn btn-primary" id="addFoodBtn" disabled>Add Food</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Edit Food Modal -->
                <div class="modal-overlay edit-modal" id="editFoodModal">
                    <div class="modal">
                        <div class="modal-header">
                            <div class="modal-title">Edit Food Item</div>
                            <button class="modal-close" onclick="closeEditFoodModal()">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M18 6L6 18"/>
                                    <path d="M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                        <form class="modal-form" id="editFoodForm" onsubmit="updateFoodItem(event)">
                            <input type="hidden" id="editMealIndex">
                            <input type="hidden" id="editFoodIndex">
                            <input type="hidden" id="editSelectedFoodCalories">
                            <div class="modal-form-group">
                                <label for="editFoodSearch">Search Food</label>
                                <div class="search-container">
                                    <div class="search-input-wrapper">
                                        <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <circle cx="11" cy="11" r="8"/>
                                            <path d="m21 21-4.35-4.35"/>
                                        </svg>
                                        <input type="text" id="editFoodSearch" placeholder="Search for a food..." autocomplete="off" required>
                                        <button type="button" class="clear-search" id="editClearSearch" style="display: none;">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M18 6L6 18"/>
                                                <path d="M6 6l12 12"/>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="search-results" id="editSearchResults"></div>
                                </div>
                            </div>
                            <div class="selected-food" id="editSelectedFoodDisplay" style="display: none;">
                                <div class="selected-food-info">
                                    <span class="selected-food-name" id="editSelectedFoodName"></span>
                                    <span class="selected-food-calories" id="editSelectedFoodCaloriesDisplay"></span>
                                </div>
                                <button type="button" class="change-food-btn" onclick="clearEditSelectedFood()">Change</button>
                            </div>
                            <div class="modal-form-group">
                                <label for="editFoodQuantity">Quantity (servings)</label>
                                <input type="number" id="editFoodQuantity" min="0.5" step="0.5" required>
                            </div>
                            <div class="calorie-preview">
                                <div class="calorie-preview-label">Total Calories</div>
                                <div class="calorie-preview-value" id="editCaloriePreview">0</div>
                            </div>
                            <div class="modal-actions">
                                <button type="button" class="btn btn-secondary" onclick="closeEditFoodModal()">Cancel</button>
                                <button type="submit" class="btn btn-primary" id="editFoodBtn">Update</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Workouts Section -->
                <section class="section" id="workouts">
                    <div class="section-header">
                        <h1 class="section-title">Workouts</h1>
                        <p class="section-subtitle">Your exercise routines and history</p>
                    </div>

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
                            <div class="card-value">5</div>
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
                            <div class="card-value">4.5h</div>
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
                            <div class="card-value">2,340</div>
                            <div class="card-label">Calories Burned</div>
                        </div>
                    </div>

                    <h3 style="margin-bottom: 16px; font-size: 18px; color: var(--text-primary);">Recent Workouts</h3>
                    <div class="workout-list">
                        <div class="workout-item">
                            <div class="workout-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M6.5 6.5h11"/>
                                    <path d="M6.5 17.5h11"/>
                                    <path d="M12 6.5v11"/>
                                </svg>
                            </div>
                            <div class="workout-info">
                                <div class="workout-name">Upper Body Strength</div>
                                <div class="workout-meta">Today at 7:00 AM</div>
                            </div>
                            <div class="workout-stats">
                                <div>
                                    <div class="workout-stat-value">45 min</div>
                                    <div class="workout-stat-label">Duration</div>
                                </div>
                                <div>
                                    <div class="workout-stat-value">380 cal</div>
                                    <div class="workout-stat-label">Burned</div>
                                </div>
                            </div>
                        </div>
                        <div class="workout-item">
                            <div class="workout-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M4 16v-2.38C4 11.5 2.97 10.5 3 8c.03-2.72 1.49-6 4.5-6C9.37 2 10 3.8 10 5.5c0 3.11-2 5.66-2 8.68V16"/>
                                    <path d="M20 20v-2.38c0-2.12 1.03-3.12 1-5.62-.03-2.72-1.49-6-4.5-6C14.63 6 14 7.8 14 9.5c0 3.11 2 5.66 2 8.68V20"/>
                                </svg>
                            </div>
                            <div class="workout-info">
                                <div class="workout-name">Morning Run</div>
                                <div class="workout-meta">Yesterday at 6:30 AM</div>
                            </div>
                            <div class="workout-stats">
                                <div>
                                    <div class="workout-stat-value">30 min</div>
                                    <div class="workout-stat-label">Duration</div>
                                </div>
                                <div>
                                    <div class="workout-stat-value">320 cal</div>
                                    <div class="workout-stat-label">Burned</div>
                                </div>
                            </div>
                        </div>
                        <div class="workout-item">
                            <div class="workout-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"/>
                                    <path d="M12 8v8"/>
                                    <path d="M8 12h8"/>
                                </svg>
                            </div>
                            <div class="workout-info">
                                <div class="workout-name">HIIT Session</div>
                                <div class="workout-meta">2 days ago</div>
                            </div>
                            <div class="workout-stats">
                                <div>
                                    <div class="workout-stat-value">25 min</div>
                                    <div class="workout-stat-label">Duration</div>
                                </div>
                                <div>
                                    <div class="workout-stat-value">450 cal</div>
                                    <div class="workout-stat-label">Burned</div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                <span class="card-badge up">-5.2kg</span>
                            </div>
                            <div class="card-value">72 kg</div>
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
                            <div class="card-value">68 kg</div>
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
                            <div class="card-value">14</div>
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
                            <div class="card-value">127</div>
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

    <script>
        // DOM Elements
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const menuToggle = document.getElementById('menuToggle');
        const themeToggle = document.getElementById('themeToggle');
        const navBtns = document.querySelectorAll('.nav-btn');
        const sections = document.querySelectorAll('.section');

        // Mobile menu toggle
        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('open');
            overlay.classList.toggle('show');
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.remove('open');
            overlay.classList.remove('show');
        });

        // Theme toggle
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

        // Navigation
        navBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const sectionId = btn.dataset.section;

                // Update active button
                navBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');

                // Show corresponding section
                sections.forEach(section => {
                    section.classList.remove('active');
                    if (section.id === sectionId) {
                        section.classList.add('active');
                    }
                });

                // Close mobile menu
                sidebar.classList.remove('open');
                overlay.classList.remove('show');
            });
        });

        // Set current date
        const dateElement = document.getElementById('currentDate');
        const greetingElement = document.getElementById('greeting');
        const now = new Date();
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        dateElement.textContent = now.toLocaleDateString('en-US', options);

        // Set greeting based on time
        const hour = now.getHours();
        let greeting = 'Good Morning';
        if (hour >= 12 && hour < 17) greeting = 'Good Afternoon';
        if (hour >= 17) greeting = 'Good Evening';
        greetingElement.textContent = `${greeting}, Alex`;

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
                bar.style.setProperty('--fill-height', `${values[index]}%`);
                bar.innerHTML = `<style>.chart-bar:nth-child(1)::after { height: ${values[index]}%; }</style>`;

                const label = document.createElement('span');
                label.className = 'chart-label';
                label.textContent = day;

                wrapper.appendChild(bar);
                wrapper.appendChild(label);
                container.appendChild(wrapper);

                // Animate bars
                setTimeout(() => {
                    bar.style.cssText = `height: ${values[index]}%; --fill: ${values[index]}%`;
                }, index * 100);
            });

            // Add fill styles
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
            const weights = [77.2, 76.5, 75.1, 74.2, 73.0, 72.0];
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

            // Add fill styles for weight chart
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

        // ============================================
        // NUTRITION SECTION FUNCTIONALITY
        // ============================================

        // Comprehensive food database with calories per serving
        const foodDatabase = [
            // Breakfast Foods
            { name: 'Oatmeal (1 cup)', calories: 158, category: 'Breakfast' },
            { name: 'Scrambled Eggs (2 eggs)', calories: 182, category: 'Breakfast' },
            { name: 'Boiled Egg (1 egg)', calories: 78, category: 'Breakfast' },
            { name: 'Fried Egg (1 egg)', calories: 90, category: 'Breakfast' },
            { name: 'Pancakes (3 medium)', calories: 350, category: 'Breakfast' },
            { name: 'Waffle (1 large)', calories: 218, category: 'Breakfast' },
            { name: 'Bagel (1 medium)', calories: 245, category: 'Breakfast' },
            { name: 'Toast with Butter (2 slices)', calories: 200, category: 'Breakfast' },
            { name: 'Croissant (1 medium)', calories: 231, category: 'Breakfast' },
            { name: 'Granola (1 cup)', calories: 597, category: 'Breakfast' },
            { name: 'Cereal with Milk (1 bowl)', calories: 220, category: 'Breakfast' },
            { name: 'French Toast (2 slices)', calories: 300, category: 'Breakfast' },
            { name: 'Bacon (3 strips)', calories: 161, category: 'Breakfast' },
            { name: 'Sausage (2 links)', calories: 180, category: 'Breakfast' },
            { name: 'Hash Browns (1 cup)', calories: 413, category: 'Breakfast' },
            
            // Proteins
            { name: 'Grilled Chicken Breast (150g)', calories: 165, category: 'Protein' },
            { name: 'Baked Salmon (150g)', calories: 280, category: 'Protein' },
            { name: 'Grilled Steak (200g)', calories: 450, category: 'Protein' },
            { name: 'Turkey Breast (150g)', calories: 135, category: 'Protein' },
            { name: 'Tuna (1 can)', calories: 191, category: 'Protein' },
            { name: 'Shrimp (100g)', calories: 99, category: 'Protein' },
            { name: 'Tofu (100g)', calories: 76, category: 'Protein' },
            { name: 'Ground Beef (150g)', calories: 384, category: 'Protein' },
            { name: 'Pork Chop (150g)', calories: 289, category: 'Protein' },
            { name: 'Lamb (150g)', calories: 294, category: 'Protein' },
            { name: 'Cod Fish (150g)', calories: 140, category: 'Protein' },
            { name: 'Tilapia (150g)', calories: 163, category: 'Protein' },
            { name: 'Chicken Thigh (150g)', calories: 229, category: 'Protein' },
            { name: 'Duck Breast (150g)', calories: 337, category: 'Protein' },
            
            // Dairy
            { name: 'Greek Yogurt (1 cup)', calories: 130, category: 'Dairy' },
            { name: 'Milk (1 glass)', calories: 149, category: 'Dairy' },
            { name: 'Cheese (30g)', calories: 113, category: 'Dairy' },
            { name: 'Cottage Cheese (1 cup)', calories: 206, category: 'Dairy' },
            { name: 'Mozzarella (30g)', calories: 85, category: 'Dairy' },
            { name: 'Cheddar Cheese (30g)', calories: 120, category: 'Dairy' },
            { name: 'Cream Cheese (2 tbsp)', calories: 99, category: 'Dairy' },
            { name: 'Butter (1 tbsp)', calories: 102, category: 'Dairy' },
            { name: 'Sour Cream (2 tbsp)', calories: 60, category: 'Dairy' },
            { name: 'Almond Milk (1 cup)', calories: 39, category: 'Dairy' },
            { name: 'Oat Milk (1 cup)', calories: 120, category: 'Dairy' },
            
            // Fruits
            { name: 'Apple (1 medium)', calories: 95, category: 'Fruit' },
            { name: 'Banana (1 medium)', calories: 105, category: 'Fruit' },
            { name: 'Orange (1 medium)', calories: 62, category: 'Fruit' },
            { name: 'Strawberries (1 cup)', calories: 49, category: 'Fruit' },
            { name: 'Blueberries (1 cup)', calories: 84, category: 'Fruit' },
            { name: 'Grapes (1 cup)', calories: 104, category: 'Fruit' },
            { name: 'Watermelon (1 cup)', calories: 46, category: 'Fruit' },
            { name: 'Mango (1 cup)', calories: 99, category: 'Fruit' },
            { name: 'Pineapple (1 cup)', calories: 82, category: 'Fruit' },
            { name: 'Avocado (1 whole)', calories: 322, category: 'Fruit' },
            { name: 'Peach (1 medium)', calories: 59, category: 'Fruit' },
            { name: 'Pear (1 medium)', calories: 102, category: 'Fruit' },
            { name: 'Kiwi (1 medium)', calories: 42, category: 'Fruit' },
            { name: 'Raspberries (1 cup)', calories: 64, category: 'Fruit' },
            { name: 'Cantaloupe (1 cup)', calories: 54, category: 'Fruit' },
            
            // Vegetables
            { name: 'Broccoli (1 cup)', calories: 55, category: 'Vegetable' },
            { name: 'Spinach (1 cup raw)', calories: 7, category: 'Vegetable' },
            { name: 'Carrots (1 cup)', calories: 52, category: 'Vegetable' },
            { name: 'Sweet Potato (1 medium)', calories: 103, category: 'Vegetable' },
            { name: 'Potato (1 medium)', calories: 161, category: 'Vegetable' },
            { name: 'Tomato (1 medium)', calories: 22, category: 'Vegetable' },
            { name: 'Cucumber (1 cup)', calories: 16, category: 'Vegetable' },
            { name: 'Bell Pepper (1 medium)', calories: 24, category: 'Vegetable' },
            { name: 'Zucchini (1 cup)', calories: 19, category: 'Vegetable' },
            { name: 'Mushrooms (1 cup)', calories: 15, category: 'Vegetable' },
            { name: 'Onion (1 medium)', calories: 44, category: 'Vegetable' },
            { name: 'Corn (1 cup)', calories: 132, category: 'Vegetable' },
            { name: 'Green Beans (1 cup)', calories: 31, category: 'Vegetable' },
            { name: 'Asparagus (1 cup)', calories: 27, category: 'Vegetable' },
            { name: 'Cauliflower (1 cup)', calories: 27, category: 'Vegetable' },
            { name: 'Kale (1 cup)', calories: 33, category: 'Vegetable' },
            { name: 'Lettuce (1 cup)', calories: 5, category: 'Vegetable' },
            
            // Grains & Carbs
            { name: 'White Rice (1 cup cooked)', calories: 206, category: 'Grains' },
            { name: 'Brown Rice (1 cup cooked)', calories: 216, category: 'Grains' },
            { name: 'Pasta (1 cup cooked)', calories: 221, category: 'Grains' },
            { name: 'Whole Wheat Bread (1 slice)', calories: 81, category: 'Grains' },
            { name: 'White Bread (1 slice)', calories: 79, category: 'Grains' },
            { name: 'Quinoa (1 cup cooked)', calories: 222, category: 'Grains' },
            { name: 'Couscous (1 cup cooked)', calories: 176, category: 'Grains' },
            { name: 'Tortilla (1 medium)', calories: 144, category: 'Grains' },
            { name: 'Pita Bread (1 piece)', calories: 165, category: 'Grains' },
            { name: 'Naan Bread (1 piece)', calories: 262, category: 'Grains' },
            
            // Legumes & Nuts
            { name: 'Black Beans (1 cup)', calories: 227, category: 'Legumes' },
            { name: 'Chickpeas (1 cup)', calories: 269, category: 'Legumes' },
            { name: 'Lentils (1 cup)', calories: 230, category: 'Legumes' },
            { name: 'Almonds (1 oz)', calories: 164, category: 'Nuts' },
            { name: 'Peanuts (1 oz)', calories: 161, category: 'Nuts' },
            { name: 'Walnuts (1 oz)', calories: 185, category: 'Nuts' },
            { name: 'Cashews (1 oz)', calories: 157, category: 'Nuts' },
            { name: 'Peanut Butter (2 tbsp)', calories: 188, category: 'Nuts' },
            { name: 'Almond Butter (2 tbsp)', calories: 196, category: 'Nuts' },
            { name: 'Mixed Nuts (1 oz)', calories: 173, category: 'Nuts' },
            
            // Prepared Meals
            { name: 'Grilled Chicken Salad', calories: 350, category: 'Meal' },
            { name: 'Caesar Salad', calories: 470, category: 'Meal' },
            { name: 'Chicken Sandwich', calories: 450, category: 'Meal' },
            { name: 'Turkey Sandwich', calories: 380, category: 'Meal' },
            { name: 'Veggie Burger', calories: 390, category: 'Meal' },
            { name: 'Beef Burger', calories: 540, category: 'Meal' },
            { name: 'Spaghetti Bolognese', calories: 520, category: 'Meal' },
            { name: 'Chicken Stir Fry', calories: 380, category: 'Meal' },
            { name: 'Fish Tacos (2)', calories: 420, category: 'Meal' },
            { name: 'Pizza Slice (1 large)', calories: 285, category: 'Meal' },
            { name: 'Sushi Roll (8 pieces)', calories: 350, category: 'Meal' },
            { name: 'Burrito Bowl', calories: 650, category: 'Meal' },
            { name: 'Chicken Wrap', calories: 410, category: 'Meal' },
            { name: 'Soup (1 bowl)', calories: 150, category: 'Meal' },
            { name: 'Grilled Fish with Vegetables', calories: 320, category: 'Meal' },
            
            // Snacks
            { name: 'Protein Bar', calories: 200, category: 'Snack' },
            { name: 'Granola Bar', calories: 140, category: 'Snack' },
            { name: 'Rice Cake (1)', calories: 35, category: 'Snack' },
            { name: 'Popcorn (3 cups)', calories: 93, category: 'Snack' },
            { name: 'Chips (1 oz)', calories: 152, category: 'Snack' },
            { name: 'Crackers (10)', calories: 130, category: 'Snack' },
            { name: 'Hummus (2 tbsp)', calories: 50, category: 'Snack' },
            { name: 'Trail Mix (1 oz)', calories: 131, category: 'Snack' },
            { name: 'Dark Chocolate (1 oz)', calories: 170, category: 'Snack' },
            { name: 'Fruit Smoothie (1 cup)', calories: 180, category: 'Snack' },
            { name: 'Protein Shake', calories: 150, category: 'Snack' },
            
            // Drinks
            { name: 'Coffee (black)', calories: 2, category: 'Drink' },
            { name: 'Coffee with Milk', calories: 30, category: 'Drink' },
            { name: 'Latte', calories: 150, category: 'Drink' },
            { name: 'Cappuccino', calories: 80, category: 'Drink' },
            { name: 'Green Tea', calories: 0, category: 'Drink' },
            { name: 'Orange Juice (1 glass)', calories: 112, category: 'Drink' },
            { name: 'Apple Juice (1 glass)', calories: 114, category: 'Drink' },
            { name: 'Soda (1 can)', calories: 140, category: 'Drink' },
            { name: 'Energy Drink', calories: 110, category: 'Drink' },
            { name: 'Sports Drink (1 bottle)', calories: 80, category: 'Drink' },
            { name: 'Coconut Water (1 cup)', calories: 46, category: 'Drink' },
            
            // Desserts
            { name: 'Ice Cream (1/2 cup)', calories: 137, category: 'Dessert' },
            { name: 'Brownie (1 piece)', calories: 227, category: 'Dessert' },
            { name: 'Cookie (1 medium)', calories: 78, category: 'Dessert' },
            { name: 'Cheesecake (1 slice)', calories: 401, category: 'Dessert' },
            { name: 'Chocolate Cake (1 slice)', calories: 352, category: 'Dessert' },
            { name: 'Donut (1 medium)', calories: 289, category: 'Dessert' },
            { name: 'Muffin (1 medium)', calories: 340, category: 'Dessert' },
            { name: 'Frozen Yogurt (1/2 cup)', calories: 110, category: 'Dessert' },
            { name: 'Fruit Salad (1 cup)', calories: 75, category: 'Dessert' }
        ];

        const mealTypes = [
            { name: 'Breakfast', icon: 'sunrise', time: '7:00 AM' },
            { name: 'Morning Snack', icon: 'coffee', time: '10:00 AM' },
            { name: 'Lunch', icon: 'sun', time: '12:30 PM' },
            { name: 'Afternoon Snack', icon: 'cookie', time: '3:30 PM' },
            { name: 'Dinner', icon: 'moon', time: '7:00 PM' },
            { name: 'Evening Snack', icon: 'star', time: '9:00 PM' }
        ];

        const mealIcons = {
            sunrise: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v2"/><path d="m4.93 4.93 1.41 1.41"/><path d="M20 12h2"/><path d="m19.07 4.93-1.41 1.41"/><path d="M15.947 12.65a4 4 0 1 0-7.894 0"/><path d="M6 20h12"/><path d="M12 12V8"/></svg>',
            coffee: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 8h1a4 4 0 1 1 0 8h-1"/><path d="M3 8h14v9a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4V8Z"/><path d="M6 2v2"/><path d="M10 2v2"/><path d="M14 2v2"/></svg>',
            sun: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="m4.93 4.93 1.41 1.41"/><path d="m17.66 17.66 1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/><path d="m6.34 17.66-1.41 1.41"/><path d="m19.07 4.93-1.41 1.41"/></svg>',
            cookie: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2a10 10 0 1 0 10 10 4 4 0 0 1-5-5 4 4 0 0 1-5-5"/><path d="M8.5 8.5v.01"/><path d="M16 15.5v.01"/><path d="M12 12v.01"/><path d="M11 17v.01"/><path d="M7 14v.01"/></svg>',
            moon: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"/></svg>',
            star: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>'
        };

        // Nutrition data state
        let nutritionData = {
            meals: [],
            calorieGoal: 2000
        };

        // Selected food state for add modal
        let selectedFood = null;
        let editSelectedFood = null;

        // Search food database
        function searchFoods(query) {
            if (!query || query.length < 2) return [];
            const searchTerm = query.toLowerCase();
            return foodDatabase.filter(food => 
                food.name.toLowerCase().includes(searchTerm) ||
                food.category.toLowerCase().includes(searchTerm)
            ).slice(0, 8);
        }

        // Render search results
        function renderSearchResults(results, containerId) {
            const container = document.getElementById(containerId);
            if (!container) return;

            if (results.length === 0) {
                container.innerHTML = '<div class="no-results">No foods found. Try a different search.</div>';
                container.classList.add('show');
                return;
            }

            container.innerHTML = results.map(food => `
                <div class="search-result-item" data-name="${food.name}" data-calories="${food.calories}">
                    <div class="search-result-info">
                        <span class="search-result-name">${food.name}</span>
                        <span class="search-result-category">${food.category}</span>
                    </div>
                    <span class="search-result-calories">${food.calories} cal</span>
                </div>
            `).join('');
            container.classList.add('show');
        }

        // Select a food from search results (Add Modal)
        function selectFood(name, calories) {
            selectedFood = { name, calories };
            document.getElementById('foodSearch').value = name;
            document.getElementById('selectedFoodCalories').value = calories;
            document.getElementById('selectedFoodName').textContent = name;
            document.getElementById('selectedFoodCaloriesDisplay').textContent = calories + ' cal per serving';
            document.getElementById('selectedFoodDisplay').style.display = 'flex';
            document.getElementById('searchResults').classList.remove('show');
            document.getElementById('clearSearch').style.display = 'none';
            document.getElementById('foodSearch').style.display = 'none';
            document.getElementById('addFoodBtn').disabled = false;
            updateAddCaloriePreview();
        }

        // Clear selected food (Add Modal)
        function clearSelectedFood() {
            selectedFood = null;
            document.getElementById('foodSearch').value = '';
            document.getElementById('foodSearch').style.display = 'block';
            document.getElementById('selectedFoodCalories').value = '';
            document.getElementById('selectedFoodDisplay').style.display = 'none';
            document.getElementById('addFoodBtn').disabled = true;
            document.getElementById('caloriePreview').textContent = '0';
        }

        // Select a food from search results (Edit Modal)
        function selectEditFood(name, calories) {
            editSelectedFood = { name, calories };
            document.getElementById('editFoodSearch').value = name;
            document.getElementById('editSelectedFoodCalories').value = calories;
            document.getElementById('editSelectedFoodName').textContent = name;
            document.getElementById('editSelectedFoodCaloriesDisplay').textContent = calories + ' cal per serving';
            document.getElementById('editSelectedFoodDisplay').style.display = 'flex';
            document.getElementById('editSearchResults').classList.remove('show');
            document.getElementById('editClearSearch').style.display = 'none';
            document.getElementById('editFoodSearch').style.display = 'none';
            updateEditCaloriePreview();
        }

        // Clear selected food (Edit Modal)
        function clearEditSelectedFood() {
            editSelectedFood = null;
            document.getElementById('editFoodSearch').value = '';
            document.getElementById('editFoodSearch').style.display = 'block';
            document.getElementById('editSelectedFoodCalories').value = '';
            document.getElementById('editSelectedFoodDisplay').style.display = 'none';
            document.getElementById('editCaloriePreview').textContent = '0';
        }

        // Load saved nutrition data
        function loadNutritionData() {
            const saved = localStorage.getItem('nutritionData');
            if (saved) {
                nutritionData = JSON.parse(saved);
                document.getElementById('calorieGoal').value = nutritionData.calorieGoal;
                document.getElementById('mealCount').value = nutritionData.meals.length || 3;
            }
            renderMeals();
            updateDailySummary();
        }

        // Save nutrition data
        function saveNutritionData() {
            localStorage.setItem('nutritionData', JSON.stringify(nutritionData));
        }

        // Initialize meals based on count
        function initializeMeals(count) {
            const existingFoods = nutritionData.meals.map(m => m.foods);
            nutritionData.meals = [];
            
            for (let i = 0; i < count; i++) {
                nutritionData.meals.push({
                    ...mealTypes[i],
                    foods: existingFoods[i] || []
                });
            }
            saveNutritionData();
            renderMeals();
            updateDailySummary();
        }

        // Render all meals
        function renderMeals() {
            const container = document.getElementById('mealsContainer');
            if (!container) return;

            container.innerHTML = nutritionData.meals.map((meal, mealIndex) => {
                const mealCalories = meal.foods.reduce((sum, food) => sum + (food.quantity * food.caloriesPerUnit), 0);
                
                return `
                    <div class="meal-card">
                        <div class="meal-header">
                            <div class="meal-header-left">
                                <div class="meal-icon">
                                    ${mealIcons[meal.icon]}
                                </div>
                                <div class="meal-info">
                                    <div class="meal-title">${meal.name}</div>
                                    <div class="meal-calories"><strong>${Math.round(mealCalories)}</strong> cal total</div>
                                </div>
                            </div>
                            <button class="add-food-btn" onclick="openAddFoodModal(${mealIndex})">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M12 5v14"/>
                                    <path d="M5 12h14"/>
                                </svg>
                                Add Food
                            </button>
                        </div>
                        <div class="meal-items" id="mealItems-${mealIndex}">
                            ${meal.foods.length === 0 ? 
                                '<div class="empty-meal">No food items added yet. Click "Add Food" to get started.</div>' :
                                meal.foods.map((food, foodIndex) => `
                                    <div class="meal-item">
                                        <div class="meal-item-left">
                                            <div class="meal-item-name">${food.name}</div>
                                            <div class="meal-item-details">${food.quantity} x ${food.caloriesPerUnit} cal</div>
                                        </div>
                                        <div class="meal-item-right">
                                            <span class="meal-item-calories">${Math.round(food.quantity * food.caloriesPerUnit)} cal</span>
                                            <div class="meal-item-actions">
                                                <button class="item-action-btn" onclick="openEditFoodModal(${mealIndex}, ${foodIndex})" title="Edit">
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                        <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/>
                                                        <path d="m15 5 4 4"/>
                                                    </svg>
                                                </button>
                                                <button class="item-action-btn delete" onclick="deleteFoodItem(${mealIndex}, ${foodIndex})" title="Delete">
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                        <path d="M3 6h18"/>
                                                        <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                                                        <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                `).join('')
                            }
                        </div>
                    </div>
                `;
            }).join('');
        }

        // Update daily summary
        function updateDailySummary() {
            const totalCalories = nutritionData.meals.reduce((sum, meal) => {
                return sum + meal.foods.reduce((mealSum, food) => mealSum + (food.quantity * food.caloriesPerUnit), 0);
            }, 0);

            const goal = nutritionData.calorieGoal;
            const percentage = Math.min((totalCalories / goal) * 100, 100);
            const remaining = Math.max(goal - totalCalories, 0);

            document.getElementById('totalCaloriesDisplay').textContent = Math.round(totalCalories).toLocaleString();
            document.getElementById('goalDisplay').textContent = goal.toLocaleString();
            document.getElementById('percentageDisplay').textContent = `${Math.round(percentage)}% of daily goal`;
            document.getElementById('remainingDisplay').textContent = totalCalories > goal ? 
                `${Math.round(totalCalories - goal)} cal over goal` : 
                `${Math.round(remaining)} cal remaining`;

            const progressFill = document.getElementById('calorieProgressFill');
            progressFill.style.width = `${Math.min(percentage, 100)}%`;
            
            // Update color based on progress
            progressFill.classList.remove('warning', 'danger');
            if (percentage > 100) {
                progressFill.classList.add('danger');
            } else if (percentage > 85) {
                progressFill.classList.add('warning');
            }
        }

        // Open add food modal
        function openAddFoodModal(mealIndex) {
            document.getElementById('currentMealIndex').value = mealIndex;
            document.getElementById('modalMealName').textContent = nutritionData.meals[mealIndex].name;
            document.getElementById('addFoodForm').reset();
            document.getElementById('foodQuantity').value = 1;
            document.getElementById('caloriePreview').textContent = '0';
            clearSelectedFood();
            document.getElementById('foodSearch').style.display = 'block';
            document.getElementById('addFoodModal').classList.add('show');
        }

        // Close add food modal
        function closeAddFoodModal() {
            document.getElementById('addFoodModal').classList.remove('show');
            document.getElementById('searchResults').classList.remove('show');
            clearSelectedFood();
        }

        // Open edit food modal
        function openEditFoodModal(mealIndex, foodIndex) {
            const food = nutritionData.meals[mealIndex].foods[foodIndex];
            document.getElementById('editMealIndex').value = mealIndex;
            document.getElementById('editFoodIndex').value = foodIndex;
            document.getElementById('editFoodQuantity').value = food.quantity;
            
            // Pre-select the current food
            editSelectedFood = { name: food.name, calories: food.caloriesPerUnit };
            document.getElementById('editFoodSearch').value = food.name;
            document.getElementById('editFoodSearch').style.display = 'none';
            document.getElementById('editSelectedFoodCalories').value = food.caloriesPerUnit;
            document.getElementById('editSelectedFoodName').textContent = food.name;
            document.getElementById('editSelectedFoodCaloriesDisplay').textContent = food.caloriesPerUnit + ' cal per serving';
            document.getElementById('editSelectedFoodDisplay').style.display = 'flex';
            document.getElementById('editCaloriePreview').textContent = Math.round(food.quantity * food.caloriesPerUnit);
            document.getElementById('editFoodModal').classList.add('show');
        }

        // Close edit food modal
        function closeEditFoodModal() {
            document.getElementById('editFoodModal').classList.remove('show');
            document.getElementById('editSearchResults').classList.remove('show');
            clearEditSelectedFood();
        }

        // Add food item
        function addFoodItem(event) {
            event.preventDefault();
            
            if (!selectedFood) return;
            
            const mealIndex = parseInt(document.getElementById('currentMealIndex').value);
            const quantity = parseFloat(document.getElementById('foodQuantity').value);

            if (selectedFood.name && quantity > 0) {
                nutritionData.meals[mealIndex].foods.push({
                    name: selectedFood.name,
                    quantity,
                    caloriesPerUnit: selectedFood.calories
                });
                saveNutritionData();
                renderMeals();
                updateDailySummary();
                closeAddFoodModal();
            }
        }

        // Update food item
        function updateFoodItem(event) {
            event.preventDefault();
            
            if (!editSelectedFood) return;
            
            const mealIndex = parseInt(document.getElementById('editMealIndex').value);
            const foodIndex = parseInt(document.getElementById('editFoodIndex').value);
            const quantity = parseFloat(document.getElementById('editFoodQuantity').value);

            if (editSelectedFood.name && quantity > 0) {
                nutritionData.meals[mealIndex].foods[foodIndex] = {
                    name: editSelectedFood.name,
                    quantity,
                    caloriesPerUnit: editSelectedFood.calories
                };
                saveNutritionData();
                renderMeals();
                updateDailySummary();
                closeEditFoodModal();
            }
        }

        // Delete food item
        function deleteFoodItem(mealIndex, foodIndex) {
            nutritionData.meals[mealIndex].foods.splice(foodIndex, 1);
            saveNutritionData();
            renderMeals();
            updateDailySummary();
        }

        // Update calorie preview in add modal
        function updateAddCaloriePreview() {
            const quantity = parseFloat(document.getElementById('foodQuantity').value) || 0;
            const caloriesPerUnit = selectedFood ? selectedFood.calories : 0;
            document.getElementById('caloriePreview').textContent = Math.round(quantity * caloriesPerUnit);
        }

        // Update calorie preview in edit modal
        function updateEditCaloriePreview() {
            const quantity = parseFloat(document.getElementById('editFoodQuantity').value) || 0;
            const caloriesPerUnit = editSelectedFood ? editSelectedFood.calories : 0;
            document.getElementById('editCaloriePreview').textContent = Math.round(quantity * caloriesPerUnit);
        }

        // Setup search functionality for Add Modal
        const foodSearchInput = document.getElementById('foodSearch');
        const searchResultsContainer = document.getElementById('searchResults');
        const clearSearchBtn = document.getElementById('clearSearch');

        if (foodSearchInput) {
            foodSearchInput.addEventListener('input', (e) => {
                const query = e.target.value;
                clearSearchBtn.style.display = query ? 'flex' : 'none';
                
                if (query.length >= 2) {
                    const results = searchFoods(query);
                    renderSearchResults(results, 'searchResults');
                } else {
                    searchResultsContainer.classList.remove('show');
                }
            });

            foodSearchInput.addEventListener('focus', (e) => {
                if (e.target.value.length >= 2) {
                    const results = searchFoods(e.target.value);
                    renderSearchResults(results, 'searchResults');
                }
            });
        }

        if (clearSearchBtn) {
            clearSearchBtn.addEventListener('click', () => {
                foodSearchInput.value = '';
                clearSearchBtn.style.display = 'none';
                searchResultsContainer.classList.remove('show');
            });
        }

        if (searchResultsContainer) {
            searchResultsContainer.addEventListener('click', (e) => {
                const item = e.target.closest('.search-result-item');
                if (item) {
                    selectFood(item.dataset.name, parseInt(item.dataset.calories));
                }
            });
        }

        // Setup search functionality for Edit Modal
        const editFoodSearchInput = document.getElementById('editFoodSearch');
        const editSearchResultsContainer = document.getElementById('editSearchResults');
        const editClearSearchBtn = document.getElementById('editClearSearch');

        if (editFoodSearchInput) {
            editFoodSearchInput.addEventListener('input', (e) => {
                const query = e.target.value;
                editClearSearchBtn.style.display = query ? 'flex' : 'none';
                
                if (query.length >= 2) {
                    const results = searchFoods(query);
                    renderSearchResults(results, 'editSearchResults');
                } else {
                    editSearchResultsContainer.classList.remove('show');
                }
            });

            editFoodSearchInput.addEventListener('focus', (e) => {
                if (e.target.value.length >= 2) {
                    const results = searchFoods(e.target.value);
                    renderSearchResults(results, 'editSearchResults');
                }
            });
        }

        if (editClearSearchBtn) {
            editClearSearchBtn.addEventListener('click', () => {
                editFoodSearchInput.value = '';
                editClearSearchBtn.style.display = 'none';
                editSearchResultsContainer.classList.remove('show');
            });
        }

        if (editSearchResultsContainer) {
            editSearchResultsContainer.addEventListener('click', (e) => {
                const item = e.target.closest('.search-result-item');
                if (item) {
                    selectEditFood(item.dataset.name, parseInt(item.dataset.calories));
                }
            });
        }

        // Quantity change handlers
        document.getElementById('foodQuantity')?.addEventListener('input', updateAddCaloriePreview);
        document.getElementById('editFoodQuantity')?.addEventListener('input', updateEditCaloriePreview);

        // Meal count change handler
        document.getElementById('mealCount')?.addEventListener('change', (e) => {
            initializeMeals(parseInt(e.target.value));
        });

        // Calorie goal change handler
        document.getElementById('calorieGoal')?.addEventListener('change', (e) => {
            nutritionData.calorieGoal = parseInt(e.target.value) || 2000;
            saveNutritionData();
            updateDailySummary();
        });

        // Close modals when clicking outside
        document.getElementById('addFoodModal')?.addEventListener('click', (e) => {
            if (e.target.id === 'addFoodModal') closeAddFoodModal();
        });
        document.getElementById('editFoodModal')?.addEventListener('click', (e) => {
            if (e.target.id === 'editFoodModal') closeEditFoodModal();
        });

        // Close search results when clicking outside
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.search-container') && !e.target.closest('.search-result-item')) {
                document.getElementById('searchResults')?.classList.remove('show');
                document.getElementById('editSearchResults')?.classList.remove('show');
            }
        });

        // Initialize nutrition on page load
        if (document.getElementById('mealsContainer')) {
            if (!localStorage.getItem('nutritionData')) {
                initializeMeals(3);
            } else {
                loadNutritionData();
            }
        }
    </script>
</body>
</html>
