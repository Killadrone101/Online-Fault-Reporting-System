<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fault Management System</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link href="{{ asset('css/landing_page.css') }}" rel="stylesheet"> 
</head>
<body class="flex flex-col min-h-screen">

  <header class="header">
    <div class="container mx-auto flex justify-between items-center">
      <h1 class="text-xl font-bold">Fault Report System</h1>
      <nav>
        <a href="#about" class="nav-link">About</a>
        <a href="{{ route('login') }}" class="nav-link">Login</a> 
      </nav>
    </div>
  </header>

  <div class="hero-image"></div>

  </div>

  <main class="main-content">
    <h2 class="main-heading">Welcome to the Fault Reporting System</h2>
    <p class="main-description">Quickly report and track maintenance issues across campus to ensure a safe and sustainable environment for all.</p>
    <a href="{{ route('login') }}" class="main-button">Report a Fault</a> 
  </main>

  <section id="about" class="about-section">
    <div class="container mx-auto">
      <h3 class="about-heading">About the System</h3>
      <p class="about-text">The Fault Report System is designed to promote efficiency in maintaining campus facilities. Students can easily report faults to ensure timely repairs and support the University's commitment to environmental stewardship and sustainability.</p>
      <p class="about-text">Together, we create a cleaner, safer, and greener university environment for everyone.</p>
    </div>
  </section>

  <footer class="footer">
    <p>&copy; 2025 Fault Management System | Facilities Management</p>
  </footer>

</body>
</html>
