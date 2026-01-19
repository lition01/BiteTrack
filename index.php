<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FitLife - Your Fitness Journey Starts Here</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    :root {
      --primary: #10b981;
      --primary-hover: #059669;
      --primary-light: #d1fae5;
      --background: #f9fafb;
      --card: #ffffff;
      --foreground: #111827;
      --muted: #6b7280;
      --border: #e5e7eb;
    }

    body {
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      background-color: var(--background);
      color: var(--foreground);
      min-height: 100vh;
      line-height: 1.5;
    }

    /* Main Layout - Equal Width */
    .container {
      display: flex;
      min-height: 100vh;
    }

    /* Left Side - Welcome */
    .welcome-section {
      flex: 1;
      background: linear-gradient(160deg, #ecfdf5 0%, #d1fae5 50%, #a7f3d0 100%);
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 3rem;
      position: relative;
    }

    .welcome-content {
      text-align: center;
      max-width: 420px;
    }

    .welcome-image {
      width: 100%;
      max-width: 320px;
      height: auto;
      border-radius: 1.25rem;
      margin-bottom: 2.5rem;
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
    }

    .logo {
      font-size: 1.5rem;
      font-weight: 700;
      color: var(--primary);
      margin-bottom: 1.5rem;
      letter-spacing: -0.025em;
    }

    .welcome-title {
      font-size: 2rem;
      font-weight: 700;
      color: var(--foreground);
      margin-bottom: 0.75rem;
      letter-spacing: -0.025em;
    }

    .welcome-subtitle {
      font-size: 1rem;
      color: var(--muted);
      line-height: 1.6;
    }

    /* Right Side - Auth Panel */
    .auth-section {
      flex: 1;
      background: var(--card);
      display: flex;
      flex-direction: column;
      justify-content: center;
      padding: 3rem 4rem;
    }

    .auth-container {
      max-width: 400px;
      width: 100%;
      margin: 0 auto;
    }

    .panel-header {
      margin-bottom: 2rem;
    }

    .panel-header h2 {
      font-size: 1.5rem;
      font-weight: 600;
      color: var(--foreground);
      margin-bottom: 0.5rem;
      letter-spacing: -0.025em;
    }

    .panel-header p {
      color: var(--muted);
      font-size: 0.9rem;
    }

    /* Form Styles */
    .form-group {
      margin-bottom: 1.25rem;
    }

    .form-label {
      display: block;
      font-size: 0.875rem;
      font-weight: 500;
      color: var(--foreground);
      margin-bottom: 0.5rem;
    }

    .form-input {
      width: 100%;
      padding: 0.75rem 1rem;
      font-size: 0.9375rem;
      border: 1.5px solid var(--border);
      border-radius: 0.625rem;
      background: var(--background);
      color: var(--foreground);
      transition: all 0.2s ease;
    }

    .form-input:focus {
      outline: none;
      border-color: var(--primary);
      background: var(--card);
      box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
    }

    .form-input::placeholder {
      color: #9ca3af;
    }

    /* Buttons */
    .btn {
      width: 100%;
      padding: 0.875rem 1.5rem;
      font-size: 0.9375rem;
      font-weight: 600;
      border: none;
      border-radius: 0.625rem;
      cursor: pointer;
      transition: all 0.2s ease;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      justify-content: center;
    }

    .btn-primary {
      background: var(--primary);
      color: white;
    }

    .btn-primary:hover {
      background: var(--primary-hover);
      transform: translateY(-1px);
      box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);
    }

    .btn-primary:active {
      transform: translateY(0);
    }

    /* Toggle Link */
    .toggle-link {
      text-align: center;
      margin-top: 1.5rem;
      color: var(--muted);
      font-size: 0.875rem;
    }

    .toggle-link a {
      color: var(--primary);
      text-decoration: none;
      font-weight: 500;
      cursor: pointer;
    }

    .toggle-link a:hover {
      text-decoration: underline;
    }

    /* Progress Bar */
    .progress-container {
      margin-bottom: 2rem;
    }

    .progress-steps {
      display: flex;
      justify-content: space-between;
      margin-bottom: 0.75rem;
    }

    .progress-step {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      font-size: 0.75rem;
      color: var(--muted);
      transition: color 0.3s ease;
    }

    .progress-step.active {
      color: var(--primary);
      font-weight: 500;
    }

    .progress-step.completed {
      color: var(--primary);
    }

    .step-number {
      width: 24px;
      height: 24px;
      border-radius: 50%;
      background: var(--border);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.7rem;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .progress-step.active .step-number,
    .progress-step.completed .step-number {
      background: var(--primary);
      color: white;
    }

    .progress-bar {
      height: 3px;
      background: var(--border);
      border-radius: 2px;
      overflow: hidden;
    }

    .progress-fill {
      height: 100%;
      background: var(--primary);
      border-radius: 2px;
      transition: width 0.4s ease;
      width: 0%;
    }

    /* Step Content */
    .step-content {
      display: none;
      animation: fadeIn 0.4s ease;
    }

    .step-content.active {
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

    .step-title {
      font-size: 1.25rem;
      font-weight: 600;
      color: var(--foreground);
      margin-bottom: 0.375rem;
      letter-spacing: -0.025em;
    }

    .step-description {
      color: var(--muted);
      margin-bottom: 1.5rem;
      font-size: 0.875rem;
    }

    /* Input Row */
    .input-row {
      display: flex;
      gap: 1rem;
    }

    .input-row .form-group {
      flex: 1;
    }

    /* Goal Options */
    .goal-options {
      display: flex;
      flex-direction: column;
      gap: 0.75rem;
      margin-bottom: 1.5rem;
    }

    .goal-option {
      display: flex;
      align-items: center;
      padding: 1rem;
      border: 1.5px solid var(--border);
      border-radius: 0.625rem;
      cursor: pointer;
      transition: all 0.2s ease;
    }

    .goal-option:hover {
      border-color: var(--primary);
      background: #f0fdf4;
    }

    .goal-option.selected {
      border-color: var(--primary);
      background: #f0fdf4;
    }

    .goal-option input {
      display: none;
    }

    .goal-icon {
      width: 36px;
      height: 36px;
      background: var(--primary-light);
      border-radius: 0.5rem;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-right: 0.875rem;
      color: var(--primary);
    }

    .goal-option.selected .goal-icon {
      background: var(--primary);
      color: white;
    }

    .goal-text h4 {
      font-size: 0.9375rem;
      font-weight: 600;
      color: var(--foreground);
      margin-bottom: 0.125rem;
    }

    .goal-text p {
      font-size: 0.75rem;
      color: var(--muted);
    }

    /* Activity Slider */
    .slider-container {
      margin-bottom: 1.5rem;
    }

    .slider-label {
      display: flex;
      justify-content: space-between;
      margin-bottom: 0.625rem;
    }

    .slider-value {
      font-weight: 600;
      color: var(--primary);
      font-size: 0.875rem;
    }

    .slider {
      width: 100%;
      height: 6px;
      border-radius: 3px;
      background: var(--border);
      outline: none;
      -webkit-appearance: none;
      cursor: pointer;
    }

    .slider::-webkit-slider-thumb {
      -webkit-appearance: none;
      width: 20px;
      height: 20px;
      border-radius: 50%;
      background: var(--primary);
      cursor: pointer;
      box-shadow: 0 2px 6px rgba(16, 185, 129, 0.3);
      transition: transform 0.2s ease;
    }

    .slider::-webkit-slider-thumb:hover {
      transform: scale(1.1);
    }

    /* Success Screen */
    .success-screen {
      text-align: center;
      padding: 1rem 0;
    }

    .success-icon {
      width: 64px;
      height: 64px;
      background: var(--primary-light);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 1.25rem;
    }

    .success-screen h2 {
      font-size: 1.375rem;
      font-weight: 600;
      margin-bottom: 0.5rem;
      letter-spacing: -0.025em;
    }

    .success-screen p {
      color: var(--muted);
      margin-bottom: 1.5rem;
      font-size: 0.9rem;
    }

    /* Responsive Design */
    @media (max-width: 900px) {
      .container {
        flex-direction: column;
      }

      .welcome-section {
        padding: 2.5rem 2rem;
        min-height: auto;
      }

      .welcome-title {
        font-size: 1.75rem;
      }

      .welcome-image {
        max-width: 260px;
        margin-bottom: 2rem;
      }

      .auth-section {
        padding: 2.5rem 2rem;
      }

      .auth-container {
        max-width: 100%;
      }
    }

    @media (max-width: 480px) {
      .welcome-section {
        padding: 2rem 1.5rem;
      }

      .welcome-title {
        font-size: 1.5rem;
      }

      .welcome-subtitle {
        font-size: 0.9rem;
      }

      .auth-section {
        padding: 2rem 1.5rem;
      }

      .input-row {
        flex-direction: column;
        gap: 0;
      }

      .progress-step span:not(.step-number) {
        display: none;
      }
    }

    /* Utility */
    .hidden {
      display: none !important;
    }
  </style>
</head>
<body>
  <div class="container">
    <!-- Left Side - Welcome Section -->
    <div class="welcome-section">
      <div class="welcome-content">
        <div class="logo">FitLife</div>
        <img src="/public/images/fitness-illustration.jpg" alt="Fitness and healthy lifestyle illustration" class="welcome-image">
        <h1 class="welcome-title">Start Your Fitness Journey</h1>
        <p class="welcome-subtitle">Transform your life with personalized workout plans and progress tracking. Your healthier self starts here.</p>
      </div>
    </div>

    <!-- Right Side - Auth Panel -->
    <div class="auth-section">
      <div class="auth-container">
        <!-- Login Form -->
        <div id="loginPanel">
          <div class="panel-header">
            <h2 id="formTitle">Welcome back</h2>
            <p id="formSubtitle">Sign in to continue your fitness journey</p>
          </div>

          <form id="loginForm">
            <div class="form-group" id="nameGroup" style="display: none;">
              <label class="form-label" for="name">Full Name</label>
              <input type="text" id="name" class="form-input" placeholder="Enter your full name">
            </div>

            <div class="form-group">
              <label class="form-label" for="email">Email</label>
              <input type="email" id="email" class="form-input" placeholder="you@example.com">
            </div>

            <div class="form-group">
              <label class="form-label" for="password">Password</label>
              <input type="password" id="password" class="form-input" placeholder="Enter your password">
            </div>

            <button type="submit" class="btn btn-primary" id="submitBtn">Sign In</button>
          </form>

          <p class="toggle-link">
            <span id="toggleText">Don't have an account?</span>
            <a id="toggleLink" onclick="toggleForm()">Create one</a>
          </p>
        </div>

        <!-- Onboarding Panel -->
        <div id="onboardingPanel" class="hidden">
          <!-- Progress Bar -->
          <div class="progress-container">
            <div class="progress-steps">
              <div class="progress-step active" data-step="1">
                <span class="step-number">1</span>
                <span>Profile</span>
              </div>
              <div class="progress-step" data-step="2">
                <span class="step-number">2</span>
                <span>Goals</span>
              </div>
              <div class="progress-step" data-step="3">
                <span class="step-number">3</span>
                <span>Activity</span>
              </div>
              <div class="progress-step" data-step="4">
                <span class="step-number">4</span>
                <span>Done</span>
              </div>
            </div>
            <div class="progress-bar">
              <div class="progress-fill" id="progressFill"></div>
            </div>
          </div>

          <!-- Step 1: Personal Info -->
          <div class="step-content active" id="step1">
            <h2 class="step-title">Tell us about yourself</h2>
            <p class="step-description">This helps us personalize your fitness experience.</p>

            <div class="form-group">
              <label class="form-label" for="age">Age</label>
              <input type="number" id="age" class="form-input" placeholder="Enter your age" min="13" max="100">
            </div>

            <div class="input-row">
              <div class="form-group">
                <label class="form-label" for="height">Height (cm)</label>
                <input type="number" id="height" class="form-input" placeholder="175" min="100" max="250">
              </div>
              <div class="form-group">
                <label class="form-label" for="weight">Weight (kg)</label>
                <input type="number" id="weight" class="form-input" placeholder="70" min="30" max="300">
              </div>
            </div>

            <button type="button" class="btn btn-primary" onclick="nextStep(2)">Continue</button>
          </div>

          <!-- Step 2: Fitness Goals -->
          <div class="step-content" id="step2">
            <h2 class="step-title">What's your goal?</h2>
            <p class="step-description">Choose the goal that best fits you.</p>

            <div class="goal-options">
              <label class="goal-option" onclick="selectGoal(this)">
                <input type="radio" name="goal" value="muscle">
                <div class="goal-icon">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M6.5 6.5c1.5 0 3-1 3-2.5S8 1.5 6.5 1.5 3.5 2.5 3.5 4s1.5 2.5 3 2.5z"/>
                    <path d="M3 22v-6l-2-4 2-2h3l2 2-2 4v6"/>
                    <path d="M17.5 6.5c-1.5 0-3-1-3-2.5s1.5-2.5 3-2.5 3 1 3 2.5-1.5 2.5-3 2.5z"/>
                    <path d="M21 22v-6l2-4-2-2h-3l-2 2 2 4v6"/>
                  </svg>
                </div>
                <div class="goal-text">
                  <h4>Build Muscle</h4>
                  <p>Gain strength and muscle mass</p>
                </div>
              </label>

              <label class="goal-option" onclick="selectGoal(this)">
                <input type="radio" name="goal" value="lose">
                <div class="goal-icon">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/>
                    <polyline points="17 6 23 6 23 12"/>
                  </svg>
                </div>
                <div class="goal-text">
                  <h4>Lose Weight</h4>
                  <p>Burn fat and get leaner</p>
                </div>
              </label>

              <label class="goal-option" onclick="selectGoal(this)">
                <input type="radio" name="goal" value="maintain">
                <div class="goal-icon">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                  </svg>
                </div>
                <div class="goal-text">
                  <h4>Stay Healthy</h4>
                  <p>Maintain overall wellness</p>
                </div>
              </label>
            </div>

            <button type="button" class="btn btn-primary" onclick="nextStep(3)">Continue</button>
          </div>

          <!-- Step 3: Activity Level -->
          <div class="step-content" id="step3">
            <h2 class="step-title">Your activity level</h2>
            <p class="step-description">Tell us about your current exercise habits.</p>

            <div class="slider-container">
              <div class="slider-label">
                <span class="form-label">Exercise per week</span>
                <span class="slider-value" id="frequencyValue">3 days</span>
              </div>
              <input type="range" class="slider" id="frequency" min="0" max="7" value="3" oninput="updateFrequency()">
            </div>

            <div class="slider-container">
              <div class="slider-label">
                <span class="form-label">Workout duration</span>
                <span class="slider-value" id="durationValue">45 min</span>
              </div>
              <input type="range" class="slider" id="duration" min="15" max="120" value="45" step="5" oninput="updateDuration()">
            </div>

            <div class="form-group">
              <label class="form-label" for="activities">Preferred activities</label>
              <input type="text" id="activities" class="form-input" placeholder="Running, Swimming, Yoga...">
            </div>

            <button type="button" class="btn btn-primary" onclick="nextStep(4)">Continue</button>
          </div>

          <!-- Step 4: Complete -->
          <div class="step-content" id="step4">
            <div class="success-screen">
              <div class="success-icon">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2.5">
                  <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                  <polyline points="22,4 12,14.01 9,11.01"/>
                </svg>
              </div>
              <h2>You're all set!</h2>
              <p>Your personalized fitness plan is ready. Let's begin your transformation.</p>
              <a href="dashboard.php" class="btn btn-primary">Go to Dashboard</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    // State
    let isLoginMode = true;
    let currentStep = 1;
    let userData = {
      name: '',
      email: '',
      age: '',
      height: '',
      weight: '',
      goal: '',
      frequency: 3,
      duration: 45,
      activities: ''
    };

    // Toggle between Login and Register
    function toggleForm() {
      isLoginMode = !isLoginMode;
      const formTitle = document.getElementById('formTitle');
      const formSubtitle = document.getElementById('formSubtitle');
      const submitBtn = document.getElementById('submitBtn');
      const toggleText = document.getElementById('toggleText');
      const toggleLink = document.getElementById('toggleLink');
      const nameGroup = document.getElementById('nameGroup');

      if (isLoginMode) {
        formTitle.textContent = 'Welcome back';
        formSubtitle.textContent = 'Sign in to continue your fitness journey';
        submitBtn.textContent = 'Sign In';
        toggleText.textContent = "Don't have an account?";
        toggleLink.textContent = 'Create one';
        nameGroup.style.display = 'none';
      } else {
        formTitle.textContent = 'Create account';
        formSubtitle.textContent = 'Start your fitness journey today';
        submitBtn.textContent = 'Create Account';
        toggleText.textContent = 'Already have an account?';
        toggleLink.textContent = 'Sign in';
        nameGroup.style.display = 'block';
      }
    }

    // Handle form submission
    document.getElementById('loginForm').addEventListener('submit', function(e) {
      e.preventDefault();
      
      const email = document.getElementById('email').value;
      const password = document.getElementById('password').value;
      const name = document.getElementById('name').value;

      if (!email || !password) {
        alert('Please fill in all required fields');
        return;
      }

      if (!isLoginMode && !name) {
        alert('Please enter your name');
        return;
      }

      userData.email = email;
      userData.name = name || email.split('@')[0];

      showOnboarding();
    });

    // Show onboarding section
    function showOnboarding() {
      document.getElementById('loginPanel').classList.add('hidden');
      document.getElementById('onboardingPanel').classList.remove('hidden');
      updateProgress();
    }

    // Update progress bar
    function updateProgress() {
      const progressFill = document.getElementById('progressFill');
      const progressSteps = document.querySelectorAll('.progress-step');
      const percentage = ((currentStep - 1) / 3) * 100;
      
      progressFill.style.width = percentage + '%';

      progressSteps.forEach((step, index) => {
        const stepNum = index + 1;
        step.classList.remove('active', 'completed');
        
        if (stepNum < currentStep) {
          step.classList.add('completed');
        } else if (stepNum === currentStep) {
          step.classList.add('active');
        }
      });
    }

    // Navigate to next step
    function nextStep(step) {
      if (currentStep === 1) {
        const age = document.getElementById('age').value;
        const height = document.getElementById('height').value;
        const weight = document.getElementById('weight').value;

        if (!age || !height || !weight) {
          alert('Please fill in all fields');
          return;
        }

        userData.age = age;
        userData.height = height;
        userData.weight = weight;
      }

      if (currentStep === 2) {
        const selectedGoal = document.querySelector('input[name="goal"]:checked');
        if (!selectedGoal) {
          alert('Please select a fitness goal');
          return;
        }
        userData.goal = selectedGoal.value;
      }

      if (currentStep === 3) {
        userData.frequency = document.getElementById('frequency').value;
        userData.duration = document.getElementById('duration').value;
        userData.activities = document.getElementById('activities').value;
      }

      document.getElementById('step' + currentStep).classList.remove('active');
      currentStep = step;
      document.getElementById('step' + currentStep).classList.add('active');
      updateProgress();
    }

    // Select fitness goal
    function selectGoal(element) {
      document.querySelectorAll('.goal-option').forEach(opt => {
        opt.classList.remove('selected');
      });
      element.classList.add('selected');
      element.querySelector('input').checked = true;
    }

    // Update frequency display
    function updateFrequency() {
      const value = document.getElementById('frequency').value;
      document.getElementById('frequencyValue').textContent = value + ' day' + (value !== '1' ? 's' : '');
    }

    // Update duration display
    function updateDuration() {
      const value = document.getElementById('duration').value;
      document.getElementById('durationValue').textContent = value + ' min';
    }
  </script>
</body>
</html>
