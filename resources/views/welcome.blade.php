<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Department of Computer Science & Engineering - KUET</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <style>
:root {
  --primary-dark: #0a0e27;
  --primary-blue: #1e3a8a;
  --light-blue: #3b82f6;
  --bright-blue: #60a5fa;
  --cyan: #06b6d4;
  --dark-bg: #0f172a;
  --darker-bg: #020617;
  --card-dark: #1e293b;
  --white: #ffffff;
  --light-text: #e2e8f0;
  --accent-blue: #2563eb;
  --hover-blue: #1d4ed8;
}

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Inter', sans-serif;
  color: var(--light-text);
  background-color: var(--dark-bg);
  line-height: 1.6;
  font-size: 16px;
  overflow-x: hidden;
}

h1, h2, h3, h4, h5, h6 {
  font-family: 'Poppins', sans-serif;
  font-weight: 700;
  line-height: 1.2;
}

/* Navbar - Fixed proportions */
.navbar {
  background: rgba(10, 14, 39, 0.95) !important;
  backdrop-filter: blur(20px);
  box-shadow: 0 4px 30px rgba(59, 130, 246, 0.3),
              0 0 20px rgba(96, 165, 250, 0.2);
  padding: 1rem 0;
  transition: all 0.3s ease;
  border-bottom: 2px solid rgba(96, 165, 250, 0.3);
  position: relative;
}

.navbar::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 2px;
  background: linear-gradient(90deg, transparent, var(--bright-blue), var(--cyan), transparent);
  animation: navGlow 3s ease-in-out infinite;
}

@keyframes navGlow {
  0%, 100% { opacity: 0.5; }
  50% { opacity: 1; }
}

.navbar.scrolled {
  padding: 0.5rem 0;
  background: rgba(10, 14, 39, 0.98) !important;
  box-shadow: 0 6px 30px rgba(59, 130, 246, 0.4),
              0 0 30px rgba(96, 165, 250, 0.3);
}

.navbar-brand {
  font-weight: 800;
  font-size: 1.5rem;
  display: flex;
  align-items: center;
  color: var(--white) !important;
  transition: all 0.3s ease;
}

.navbar-brand:hover {
  color: var(--bright-blue) !important;
}

.navbar-brand img {
  height: 45px;
  margin-right: 12px;
  filter: drop-shadow(0 2px 8px rgba(96, 165, 250, 0.4));
}

.nav-link {
  font-weight: 500;
  margin: 0 0.25rem;
  padding: 0.5rem 1rem !important;
  border-radius: 8px;
  transition: all 0.3s ease;
  color: rgba(255, 255, 255, 0.85) !important;
  font-size: 0.95rem;
  position: relative;
}

.nav-link::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 50%;
  transform: translateX(-50%) scaleX(0);
  width: 80%;
  height: 2px;
  background: var(--bright-blue);
  transition: transform 0.3s ease;
}

.nav-link:hover::after,
.nav-link.active::after {
  transform: translateX(-50%) scaleX(1);
}

.nav-link:hover,
.nav-link.active {
  color: var(--bright-blue) !important;
  background: rgba(96, 165, 250, 0.1);
}

/* Hero Section - Balanced proportions */
.hero {
  background: linear-gradient(135deg, rgba(10, 14, 39, 0.95) 0%, rgba(30, 58, 138, 0.92) 50%, rgba(15, 23, 42, 0.95) 100%), 
              url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80') center/cover no-repeat fixed;
  color: var(--white);
  padding: 140px 0 100px;
  text-align: center;
  position: relative;
  overflow: hidden;
  min-height: 90vh;
  display: flex;
  align-items: center;
}

.hero::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: radial-gradient(circle at 30% 50%, rgba(59, 130, 246, 0.2) 0%, transparent 50%),
              radial-gradient(circle at 70% 80%, rgba(96, 165, 250, 0.15) 0%, transparent 50%),
              radial-gradient(circle at 50% 20%, rgba(6, 182, 212, 0.1) 0%, transparent 50%);
  animation: heroGlowPulse 8s ease-in-out infinite;
}

.hero::after {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-image: 
    radial-gradient(circle, rgba(96, 165, 250, 0.8) 1px, transparent 1px),
    radial-gradient(circle, rgba(59, 130, 246, 0.6) 1px, transparent 1px);
  background-size: 50px 50px, 80px 80px;
  background-position: 0 0, 40px 40px;
  animation: starsMove 20s linear infinite;
  opacity: 0.3;
}

@keyframes heroGlowPulse {
  0%, 100% { opacity: 0.6; }
  50% { opacity: 1; }
}

@keyframes starsMove {
  0% { transform: translateY(0); }
  100% { transform: translateY(-80px); }
}

.hero > * {
  position: relative;
  z-index: 2;
}

.hero h1 {
  font-size: 4rem;
  font-weight: 900;
  margin-bottom: 1.5rem;
  background: linear-gradient(135deg, var(--white) 0%, var(--bright-blue) 50%, var(--cyan) 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  letter-spacing: -1px;
  text-shadow: 0 0 60px rgba(96, 165, 250, 0.3);
  filter: drop-shadow(0 4px 20px rgba(59, 130, 246, 0.4));
  animation: titleGlow 4s ease-in-out infinite;
}

@keyframes titleGlow {
  0%, 100% {
    filter: drop-shadow(0 4px 20px rgba(59, 130, 246, 0.4));
  }
  50% {
    filter: drop-shadow(0 4px 30px rgba(96, 165, 250, 0.6));
  }
}

.hero p {
  font-size: 1.3rem;
  max-width: 700px;
  margin: 0 auto 1.5rem;
  font-weight: 400;
  opacity: 0.9;
}

.typed-text-container {
  font-size: 1.8rem;
  font-weight: 700;
  color: var(--bright-blue);
  min-height: 50px;
  margin-bottom: 2.5rem;
  text-shadow: 0 0 40px rgba(96, 165, 250, 0.8),
               0 0 60px rgba(59, 130, 246, 0.5);
  animation: textGlow 2s ease-in-out infinite alternate;
}

@keyframes textGlow {
  0% {
    text-shadow: 0 0 40px rgba(96, 165, 250, 0.8),
                 0 0 60px rgba(59, 130, 246, 0.5);
  }
  100% {
    text-shadow: 0 0 60px rgba(96, 165, 250, 1),
                 0 0 80px rgba(6, 182, 212, 0.7);
  }
}

.hero-btn {
  background: linear-gradient(135deg, var(--light-blue) 0%, var(--bright-blue) 100%);
  color: var(--white);
  font-weight: 800;
  padding: 0.9rem 2rem; /* reduced padding */
  border-radius: 40px;
  border: 2px solid rgba(255, 255, 255, 0.22);
  transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  box-shadow: 0 15px 50px rgba(59, 130, 246, 0.6),
              0 0 40px rgba(96, 165, 250, 0.4),
              inset 0 0 20px rgba(255, 255, 255, 0.1);
  text-transform: uppercase;
  letter-spacing: 2px;
  font-size: 1rem; /* slightly smaller text */
  display: inline-flex;
  align-items: center;
  gap: 0.6rem; /* smaller gap between text and icon */
  position: relative;
  overflow: hidden;
  animation: heroButtonPulse 3s ease-in-out infinite;
}

@keyframes heroButtonPulse {
  0%, 100% {
    box-shadow: 0 15px 50px rgba(59, 130, 246, 0.6),
                0 0 40px rgba(96, 165, 250, 0.4),
                inset 0 0 20px rgba(255, 255, 255, 0.1);
  }
  50% {
    box-shadow: 0 20px 60px rgba(59, 130, 246, 0.8),
                0 0 60px rgba(96, 165, 250, 0.6),
                inset 0 0 30px rgba(255, 255, 255, 0.2);
  }
}

.hero-btn::before {
  content: '';
  position: absolute;
  top: 50%;
  left: 50%;
  width: 0;
  height: 0;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.3);
  transform: translate(-50%, -50%);
  transition: width 0.6s ease, height 0.6s ease;
}

.hero-btn:hover::before {
  width: 220px; /* scaled down ripple */
  height: 220px;
}

.hero-btn:hover {
  transform: translateY(-8px) scale(1.05);
  box-shadow: 0 25px 70px rgba(96, 165, 250, 0.9),
              0 0 80px rgba(6, 182, 212, 0.7),
              inset 0 0 40px rgba(255, 255, 255, 0.2);
  background: linear-gradient(135deg, var(--bright-blue) 0%, var(--cyan) 100%);
  border-color: var(--cyan);
  animation: none;
}

.hero-btn i {
  font-size: 1.5rem;
  transition: transform 0.4s ease;
  font-weight: bold;
}

.hero-btn:hover i {
  transform: translateX(8px) rotate(5deg);
}

/* Section Styling - Consistent spacing */
section {
  padding: 80px 0;
}

.section-header {
  text-align: center;
  margin-bottom: 4rem;
}

.section-header h2 {
  color: var(--bright-blue);
  font-weight: 900;
  font-size: 3rem;
  position: relative;
  display: inline-block;
  padding-bottom: 1.2rem;
  margin-bottom: 1.2rem;
  text-transform: uppercase;
  letter-spacing: 2px;
  text-shadow: 0 0 40px rgba(96, 165, 250, 0.6),
               0 4px 20px rgba(59, 130, 246, 0.4);
  animation: headingGlow 3s ease-in-out infinite alternate;
}

@keyframes headingGlow {
  0% {
    text-shadow: 0 0 40px rgba(96, 165, 250, 0.6),
                 0 4px 20px rgba(59, 130, 246, 0.4);
  }
  100% {
    text-shadow: 0 0 60px rgba(96, 165, 250, 0.9),
                 0 4px 30px rgba(59, 130, 246, 0.6);
  }
}

.section-header h2::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 50%;
  transform: translateX(-50%);
  width: 100px;
  height: 5px;
  background: linear-gradient(90deg, transparent, var(--bright-blue), var(--cyan), transparent);
  border-radius: 3px;
  box-shadow: 0 0 20px rgba(96, 165, 250, 0.8);
  animation: underlineGlow 2s ease-in-out infinite;
}

@keyframes underlineGlow {
  0%, 100% {
    box-shadow: 0 0 20px rgba(96, 165, 250, 0.8);
    width: 100px;
  }
  50% {
    box-shadow: 0 0 30px rgba(96, 165, 250, 1);
    width: 130px;
  }
}

.section-header p {
  font-size: 1.1rem;
  color: rgba(255, 255, 255, 0.7);
  max-width: 600px;
  margin: 0 auto;
}

/* About Section - Better image handling */
#about {
  background: linear-gradient(180deg, var(--dark-bg) 0%, var(--primary-dark) 100%);
}

#about .about-content h3 {
  color: var(--bright-blue);
  font-weight: 700;
  font-size: 2rem;
  margin-bottom: 1.5rem;
  position: relative;
  padding-left: 1.5rem;
}

#about .about-content h3::before {
  content: '';
  position: absolute;
  left: 0;
  top: 0;
  width: 4px;
  height: 100%;
  background: linear-gradient(180deg, var(--bright-blue), var(--cyan));
  border-radius: 2px;
}

#about .about-content p {
  font-size: 1.05rem;
  line-height: 1.8;
  color: rgba(255, 255, 255, 0.8);
  margin-bottom: 1.25rem;
}

#about .about-img img {
  border-radius: 20px;
  box-shadow: 0 15px 50px rgba(59, 130, 246, 0.4),
              0 0 30px rgba(96, 165, 250, 0.3);
  transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  border: 3px solid rgba(96, 165, 250, 0.3);
  width: 100%;
  height: auto;
  object-fit: cover;
  position: relative;
}

#about .about-img {
  position: relative;
}

#about .about-img::before {
  content: '';
  position: absolute;
  top: -10px;
  left: -10px;
  right: -10px;
  bottom: -10px;
  background: linear-gradient(135deg, var(--light-blue), var(--cyan));
  border-radius: 20px;
  opacity: 0;
  transition: opacity 0.5s ease;
  z-index: -1;
  filter: blur(20px);
}

#about .about-img:hover::before {
  opacity: 0.6;
}

#about .about-img img:hover {
  transform: translateY(-8px) scale(1.02);
  box-shadow: 0 20px 70px rgba(59, 130, 246, 0.6),
              0 0 50px rgba(96, 165, 250, 0.5);
  border-color: rgba(96, 165, 250, 0.6);
}

/* Faculty Section - COMPLETELY REDESIGNED */
#faculty {
  background: var(--primary-dark);
}

.faculty-container {
  position: relative;
}

.faculty-head-card {
  background: rgba(10, 14, 39, 0.85);
  backdrop-filter: blur(15px);
  border-radius: 20px;
  padding: 2.5rem;
  box-shadow: 0 15px 50px rgba(59, 130, 246, 0.4),
              0 0 40px rgba(96, 165, 250, 0.3),
              inset 0 0 30px rgba(59, 130, 246, 0.1);
  border: 2px solid rgba(96, 165, 250, 0.4);
  margin-bottom: 3rem;
  transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  position: relative;
  overflow: hidden;
}

.faculty-head-card::before {
  content: '';
  position: absolute;
  top: -50%;
  left: -50%;
  width: 200%;
  height: 200%;
  background: linear-gradient(45deg, transparent, rgba(96, 165, 250, 0.1), transparent);
  transform: rotate(45deg);
  transition: all 0.6s ease;
  opacity: 0;
}

.faculty-head-card:hover::before {
  animation: cardShimmer 1.5s ease-in-out;
  opacity: 1;
}

.faculty-head-card:hover {
  transform: translateY(-8px) scale(1.01);
  box-shadow: 0 20px 60px rgba(59, 130, 246, 0.5),
              0 0 50px rgba(96, 165, 250, 0.4),
              inset 0 0 50px rgba(59, 130, 246, 0.1);
  border-color: rgba(96, 165, 250, 0.6);
}

.head-of-department {
  display: flex;
  align-items: center;
  gap: 2rem;
}

.head-image {
  flex: 0 0 180px;
}

.head-image img {
  width: 180px;
  height: 180px;
  border-radius: 50%;
  object-fit: cover;
  border: 3px solid rgba(96, 165, 250, 0.5);
  box-shadow: 0 0 30px rgba(96, 165, 250, 0.4);
  transition: all 0.4s ease;
}

.faculty-head-card:hover .head-image img {
  transform: scale(1.05);
  box-shadow: 0 0 40px rgba(96, 165, 250, 0.6);
}

.head-info {
  flex: 1;
}

.head-info h3 {
  color: var(--bright-blue);
  font-size: 1.8rem;
  margin-bottom: 0.5rem;
  font-weight: 700;
}

.head-info .designation {
  color: var(--cyan);
  font-size: 1.2rem;
  font-weight: 600;
  margin-bottom: 0.5rem;
}

.head-info .research {
  color: rgba(255, 255, 255, 0.8);
  font-size: 1rem;
  margin-bottom: 1.5rem;
  line-height: 1.6;
}

.head-badge {
  background: linear-gradient(135deg, var(--light-blue), var(--cyan));
  color: white;
  padding: 0.4rem 1rem;
  border-radius: 20px;
  font-size: 0.85rem;
  font-weight: 600;
  display: inline-block;
  margin-bottom: 1rem;
}

/* Regular Faculty Cards */
.faculty-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 2rem;
}

.faculty-card {
  background: rgba(10, 14, 39, 0.85);
  backdrop-filter: blur(15px);
  border-radius: 20px;
  padding: 2rem;
  box-shadow: 0 10px 40px rgba(59, 130, 246, 0.3),
              0 0 20px rgba(96, 165, 250, 0.2),
              inset 0 0 30px rgba(59, 130, 246, 0.05);
  transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  border: 2px solid rgba(96, 165, 250, 0.3);
  text-align: center;
  position: relative;
  overflow: hidden;
}

.faculty-card::before {
  content: '';
  position: absolute;
  top: -50%;
  left: -50%;
  width: 200%;
  height: 200%;
  background: linear-gradient(45deg, transparent, rgba(96, 165, 250, 0.1), transparent);
  transform: rotate(45deg);
  transition: all 0.6s ease;
  opacity: 0;
}

.faculty-card:hover::before {
  animation: cardShimmer 1.5s ease-in-out;
  opacity: 1;
}

@keyframes cardShimmer {
  0% { left: -100%; }
  100% { left: 100%; }
}

.faculty-card:hover {
  transform: translateY(-12px) scale(1.03);
  box-shadow: 0 20px 60px rgba(59, 130, 246, 0.5),
              0 0 40px rgba(96, 165, 250, 0.4),
              inset 0 0 50px rgba(59, 130, 246, 0.1);
  border-color: rgba(96, 165, 250, 0.6);
}

.faculty-image {
  width: 140px;
  height: 140px;
  border-radius: 50%;
  object-fit: cover;
  border: 3px solid rgba(96, 165, 250, 0.4);
  margin: 0 auto 1.5rem;
  box-shadow: 0 0 25px rgba(96, 165, 250, 0.3);
  transition: all 0.4s ease;
}

.faculty-card:hover .faculty-image {
  transform: scale(1.08);
  box-shadow: 0 0 35px rgba(96, 165, 250, 0.5);
}

.faculty-name {
  color: var(--bright-blue);
  font-size: 1.4rem;
  font-weight: 700;
  margin-bottom: 0.5rem;
}

.faculty-designation {
  color: var(--cyan);
  font-size: 1rem;
  font-weight: 600;
  margin-bottom: 1rem;
}

.faculty-research {
  color: rgba(255, 255, 255, 0.8);
  font-size: 0.9rem;
  line-height: 1.5;
  margin-bottom: 1.5rem;
  min-height: 60px;
}

.faculty-btn {
  background: linear-gradient(135deg, var(--primary-blue) 0%, var(--light-blue) 100%);
  color: var(--white);
  border: 2px solid rgba(96, 165, 250, 0.3);
  padding: 0.8rem 1.8rem;
  border-radius: 30px;
  transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 1px;
  font-size: 0.9rem;
  box-shadow: 0 6px 25px rgba(59, 130, 246, 0.3),
              inset 0 0 15px rgba(255, 255, 255, 0.05);
  position: relative;
  overflow: hidden;
  display: inline-block;
  text-decoration: none;
  cursor: pointer;
  z-index: 10;
}

.faculty-btn::before {
  content: '';
  position: absolute;
  top: 50%;
  left: 50%;
  width: 0;
  height: 0;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.2);
  transform: translate(-50%, -50%);
  transition: width 0.5s ease, height 0.5s ease;
}

.faculty-btn:hover::before {
  width: 300px;
  height: 300px;
}

.faculty-btn:hover {
  background: linear-gradient(135deg, var(--bright-blue) 0%, var(--cyan) 100%);
  transform: translateY(-4px) scale(1.05);
  box-shadow: 0 12px 35px rgba(96, 165, 250, 0.6),
              0 0 25px rgba(6, 182, 212, 0.4);
  border-color: var(--cyan);
  color: white;
  text-decoration: none;
}

/* Students Section - Balanced cards */
.students-section {
  background: linear-gradient(180deg, var(--dark-bg) 0%, var(--primary-blue) 50%, var(--dark-bg) 100%);
  position: relative;
}

.student-card {
  background: rgba(10, 14, 39, 0.85);
  backdrop-filter: blur(15px);
  border-radius: 20px;
  padding: 2.5rem 2rem;
  box-shadow: 0 10px 40px rgba(59, 130, 246, 0.3),
              0 0 25px rgba(96, 165, 250, 0.2),
              inset 0 0 30px rgba(59, 130, 246, 0.05);
  height: 100%;
  transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  border: 2px solid rgba(96, 165, 250, 0.3);
  text-align: center;
  position: relative;
  overflow: hidden;
}

.student-card::after {
  content: '';
  position: absolute;
  top: -50%;
  left: -50%;
  width: 200%;
  height: 200%;
  background: radial-gradient(circle, rgba(96, 165, 250, 0.1) 0%, transparent 70%);
  opacity: 0;
  transition: opacity 0.5s ease;
}

.student-card:hover::after {
  opacity: 1;
  animation: cardPulse 2s ease-in-out infinite;
}

@keyframes cardPulse {
  0%, 100% { transform: scale(1); }
  50% { transform: scale(1.1); }
}

.student-card:hover {
  transform: translateY(-12px) scale(1.03);
  box-shadow: 0 20px 60px rgba(59, 130, 246, 0.5),
              0 0 50px rgba(96, 165, 250, 0.4),
              inset 0 0 50px rgba(59, 130, 246, 0.1);
  border-color: rgba(96, 165, 250, 0.6);
}

.student-card i {
  font-size: 4.5rem;
  background: linear-gradient(135deg, var(--light-blue), var(--bright-blue), var(--cyan));
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  margin-bottom: 1.5rem;
  display: block;
  filter: drop-shadow(0 4px 20px rgba(96, 165, 250, 0.6));
  animation: iconFloat 3s ease-in-out infinite;
  position: relative;
  z-index: 2;
}

@keyframes iconFloat {
  0%, 100% {
    transform: translateY(0px);
    filter: drop-shadow(0 4px 20px rgba(96, 165, 250, 0.6));
  }
  50% {
    transform: translateY(-10px);
    filter: drop-shadow(0 8px 30px rgba(96, 165, 250, 0.9));
  }
}

.student-card h4 {
  color: var(--bright-blue);
  margin-bottom: 1rem;
  font-weight: 700;
  font-size: 1.5rem;
}

.student-card p {
  color: rgba(255, 255, 255, 0.8);
  font-size: 1rem;
  line-height: 1.6;
  margin-bottom: 1.5rem;
}

/* Notices Section - Cleaner design */
#notices {
  background: var(--primary-dark);
}

.notice-item {
  border-left: 6px solid var(--bright-blue);
  padding: 1.8rem 2.5rem;
  margin-bottom: 1.8rem;
  background: rgba(10, 14, 39, 0.85);
  backdrop-filter: blur(15px);
  border-radius: 0 16px 16px 0;
  box-shadow: 0 6px 30px rgba(59, 130, 246, 0.3),
              0 0 20px rgba(96, 165, 250, 0.2),
              inset 0 0 25px rgba(59, 130, 246, 0.05);
  transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  border: 2px solid rgba(96, 165, 250, 0.2);
  border-left: 6px solid var(--bright-blue);
  position: relative;
  overflow: hidden;
}

.notice-item::before {
  content: '';
  position: absolute;
  left: 0;
  top: 0;
  width: 0;
  height: 100%;
  background: linear-gradient(90deg, rgba(96, 165, 250, 0.15), transparent);
  transition: width 0.5s ease;
  pointer-events: none; /* avoid blocking clicks */
  z-index: 0;
}

.notice-item:hover::before {
  width: 100%;
}

.notice-item:hover {
  transform: translateX(15px) scale(1.02);
  box-shadow: 0 10px 45px rgba(59, 130, 246, 0.5),
              0 0 40px rgba(96, 165, 250, 0.4);
  border-left-color: var(--cyan);
  border-color: rgba(96, 165, 250, 0.5);
}

.notice-date {
  color: var(--bright-blue);
  font-weight: 600;
  font-size: 0.9rem;
  margin-bottom: 0.75rem;
  display: inline-block;
  padding: 0.25rem 1rem;
  background: rgba(59, 130, 246, 0.15);
  border-radius: 15px;
}

.notice-title {
  color: var(--bright-blue);
  font-weight: 700;
  font-size: 1.25rem;
  margin-bottom: 0.75rem;
}

.notice-item p {
  color: rgba(255, 255, 255, 0.8);
  font-size: 1rem;
  line-height: 1.6;
  margin: 0;
  position: relative;
  z-index: 1; /* above decorative overlay */
}

.notice-item .text-primary {
  color: var(--bright-blue) !important;
  text-decoration: none;
  font-weight: 600;
  transition: all 0.3s ease;
}

.notice-item .text-primary:hover {
  color: #38bdf8 !important;
  text-decoration: underline;
}

/* Contact Section - Better form styling */
.contact-section {
  background: linear-gradient(180deg, var(--dark-bg) 0%, var(--primary-blue) 50%, var(--dark-bg) 100%);
  color: white;
  position: relative;
}

.contact-info {
  margin-bottom: 2rem;
}

.contact-info h4 {
  font-size: 1.75rem;
  font-weight: 700;
  margin-bottom: 1rem;
  color: var(--bright-blue);
  text-shadow: 0 0 30px rgba(96, 165, 250, 0.6);
  animation: textGlow 2s ease-in-out infinite alternate;
}

.contact-info p {
  font-size: 1.05rem;
  line-height: 1.7;
  color: rgba(255, 255, 255, 0.8);
}

.contact-info i {
  font-size: 1.5rem;
  color: var(--bright-blue);
  margin-right: 1rem;
  min-width: 35px;
  filter: drop-shadow(0 0 15px rgba(96, 165, 250, 0.8));
  animation: iconPulse 2s ease-in-out infinite;
}

@keyframes iconPulse {
  0%, 100% {
    filter: drop-shadow(0 0 15px rgba(96, 165, 250, 0.8));
  }
  50% {
    filter: drop-shadow(0 0 25px rgba(96, 165, 250, 1));
  }
}

.contact-info h5 {
  font-weight: 600;
  font-size: 1.2rem;
  color: var(--bright-blue);
  margin-bottom: 0.5rem;
}

.contact-form {
  background: rgba(10, 14, 39, 0.85);
  backdrop-filter: blur(15px);
  padding: 2.5rem;
  border-radius: 20px;
  box-shadow: 0 15px 50px rgba(59, 130, 246, 0.4),
              0 0 40px rgba(96, 165, 250, 0.3),
              inset 0 0 30px rgba(59, 130, 246, 0.1);
  border: 2px solid rgba(96, 165, 250, 0.4);
  position: relative;
  overflow: hidden;
}

.contact-form::after {
  content: '';
  position: absolute;
  top: -50%;
  left: -50%;
  width: 200%;
  height: 200%;
  background: linear-gradient(45deg, transparent, rgba(96, 165, 250, 0.05), transparent);
  animation: formShimmer 3s infinite;
  pointer-events: none;
}

@keyframes formShimmer {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

.contact-form h4 {
  font-size: 1.75rem;
  font-weight: 700;
  margin-bottom: 2rem;
  color: var(--bright-blue);
}

.contact-form .form-control {
  padding: 0.875rem 1.25rem;
  margin-bottom: 1.25rem;
  border: 1px solid rgba(96, 165, 250, 0.3);
  border-radius: 8px;
  font-size: 1rem;
  transition: all 0.3s ease;
  background: rgba(30, 58, 138, 0.2);
  color: white;
}

.contact-form .form-control::placeholder {
  color: rgba(255, 255, 255, 0.4);
}

.contact-form .form-control:focus {
  border-color: var(--bright-blue);
  box-shadow: 0 0 0 4px rgba(96, 165, 250, 0.3),
              0 0 25px rgba(59, 130, 246, 0.4),
              inset 0 0 20px rgba(96, 165, 250, 0.1);
  background: rgba(30, 58, 138, 0.4);
  outline: none;
  transform: translateY(-2px);
}

.contact-form .btn {
  background: linear-gradient(135deg, var(--primary-blue) 0%, var(--light-blue) 100%);
  color: var(--white);
  padding: 1rem 2.5rem;
  border: none;
  border-radius: 25px;
  font-weight: 700;
  transition: all 0.3s ease;
  text-transform: uppercase;
  letter-spacing: 1px;
  font-size: 1rem;
}

.contact-form .btn:hover {
  background: linear-gradient(135deg, var(--bright-blue) 0%, var(--cyan) 100%);
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(96, 165, 250, 0.5);
}

/* Footer - Cleaner layout */
footer {
  background: var(--primary-dark);
  color: #e8e8e8;
  padding: 60px 0 20px;
  border-top: 1px solid rgba(96, 165, 250, 0.2);
}

.footer-logo {
  font-size: 1.75rem;
  font-weight: 800;
  color: var(--bright-blue);
  margin-bottom: 1.5rem;
  display: inline-block;
}

footer p {
  font-size: 1rem;
  line-height: 1.7;
  color: rgba(255, 255, 255, 0.7);
}

.footer-links h5 {
  color: var(--bright-blue);
  margin-bottom: 1.5rem;
  font-weight: 700;
  font-size: 1.2rem;
}

.footer-links ul {
  list-style: none;
  padding: 0;
}

.footer-links li {
  margin-bottom: 0.75rem;
}

.footer-links a {
  color: rgba(255, 255, 255, 0.7);
  text-decoration: none;
  transition: all 0.3s ease;
  font-size: 1rem;
}

.footer-links a:hover {
  color: var(--bright-blue);
  padding-left: 5px;
}

.social-icons a {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 45px;
  height: 45px;
  background: rgba(59, 130, 246, 0.2);
  color: var(--bright-blue);
  border-radius: 50%;
  margin-right: 0.75rem;
  transition: all 0.3s ease;
  border: 1px solid rgba(96, 165, 250, 0.3);
  font-size: 1.1rem;
}

.social-icons a:hover {
  background: linear-gradient(135deg, var(--light-blue), var(--cyan));
  color: var(--white);
  transform: translateY(-3px);
  box-shadow: 0 5px 20px rgba(96, 165, 250, 0.4);
}

.copyright {
  border-top: 1px solid rgba(96, 165, 250, 0.15);
  padding-top: 1.5rem;
  margin-top: 3rem;
  text-align: center;
  color: rgba(255, 255, 255, 0.6);
  font-size: 0.95rem;
}

/* Back to Top Button - Fixed size */
.back-to-top {
  position: fixed;
  bottom: 30px;
  right: 30px;
  width: 50px;
  height: 50px;
  background: linear-gradient(135deg, var(--primary-blue), var(--light-blue));
  color: var(--white);
  border: none;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.3rem;
  box-shadow: 0 4px 20px rgba(59, 130, 246, 0.4);
  opacity: 0;
  visibility: hidden;
  transition: all 0.3s ease;
  z-index: 1000;
  cursor: pointer;
}

.back-to-top.active {
  opacity: 1;
  visibility: visible;
}

.back-to-top:hover {
  background: linear-gradient(135deg, var(--bright-blue), var(--cyan));
  transform: translateY(-5px);
  box-shadow: 0 6px 25px rgba(96, 165, 250, 0.6);
}

/* Smooth Scrolling */
html {
  scroll-behavior: smooth;
}

/* Selection Color */
::selection {
  background: var(--bright-blue);
  color: var(--white);
}

/* Responsive */
@media (max-width: 768px) {
  .hero {
    padding: 120px 0 80px;
    min-height: 80vh;
  }
  
  .hero h1 {
    font-size: 2.5rem;
  }
  
  .hero p {
    font-size: 1.1rem;
  }
  
  .typed-text-container {
    font-size: 1.3rem;
  }
  
  .hero-btn {
    padding: 1.3rem 2.5rem;
    font-size: 1rem;
    letter-spacing: 1px;
  }
  
  .hero-btn i {
    font-size: 1.2rem;
  }
  
  .section-header h2 {
    font-size: 2.2rem;
  }
  
  section {
    padding: 60px 0;
  }
  
  .contact-form {
    padding: 2rem;
  }
  
  .faculty-card, .student-card, .notice-item {
    margin-bottom: 1.5rem;
  }
  
  .head-of-department {
    flex-direction: column;
    text-align: center;
  }
  
  .head-image {
    flex: 0 0 auto;
  }
  
  .faculty-grid {
    grid-template-columns: 1fr;
  }
}

@media (max-width: 576px) {
  .hero-btn {
    padding: 1.2rem 2rem;
    font-size: 0.95rem;
  }
  
  .faculty-head-card {
    padding: 1.5rem;
  }
}
  </style>
</head>
<body>
  <a href="#" class="back-to-top">
    <i class="bi bi-chevron-up"></i>
  </a>

  <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="KUET_CSE.png" alt="KUET Logo">
        KUET CSE
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link active" href="#home">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
          <li class="nav-item"><a class="nav-link" href="#faculty">Faculty</a></li>
          <li class="nav-item"><a class="nav-link" href="#students">Students</a></li>
          <li class="nav-item"><a class="nav-link" href="#notices">Notices</a></li>
          <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <section id="home" class="hero">
    <div class="container">
      <h1 class="animate__animated animate__fadeInDown">Department of Computer Science & Engineering</h1>
      <p class="animate__animated animate__fadeInUp">Khulna University of Engineering & Technology</p>
      <p class="typed-text-container animate__animated animate__fadeInUp animate__delay-1s">
        <span class="typed-text"></span>
      </p>
      <button class="btn hero-btn animate__animated animate__zoomIn animate__delay-2s">
        Explore Our Programs 
        <i class="bi bi-arrow-right"></i>
      </button>
    </div>
  </section>

  <section id="about" class="py-5">
    <div class="container">
      <div class="section-header">
        <h2>About Our Department</h2>
      </div>
      <div class="row align-items-center g-5">
        <div class="col-lg-6 about-content">
          <h3>Welcome to KUET CSE</h3>
          <p>The Department of Computer Science and Engineering (CSE) at Khulna University of Engineering & Technology (KUET) is one of the leading departments in the field of computer science and engineering education in Bangladesh.</p>
          <p>Established in 1999, the department offers undergraduate and postgraduate programs with a focus on producing skilled computer engineers and researchers who can contribute to the technological advancement of the country.</p>
          <p>Our curriculum is designed to provide students with a strong foundation in both theoretical and practical aspects of computer science, preparing them for successful careers in industry, academia, and research.</p>
          <button class="btn faculty-btn mt-3">Learn More</button>
        </div>
        <div class="col-lg-6 about-img">
          <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" alt="CSE Department" class="img-fluid">
        </div>
      </div>
    </div>
  </section>

  <section id="faculty" class="py-5">
    <div class="container">
      <div class="section-header">
        <h2>Our Faculty Members</h2>
        <p>Meet our distinguished faculty members</p>
      </div>
      
      <div class="faculty-container">
        @php
          $head = isset($teachers) ? $teachers->firstWhere('is_head', true) : null;
          $others = isset($teachers) ? $teachers->filter(function($t) { return !$t->is_head; }) : collect();
        @endphp

        @if($head)
          <!-- Head of Department -->
          <div class="faculty-head-card">
            <div class="head-of-department">
              <div class="head-image">
                <img src="{{ $head->profile_image ?: 'https://via.placeholder.com/400x400?text=Profile' }}" alt="Head of Department">
              </div>
              <div class="head-info">
                <span class="head-badge">Head of Department</span>
                <h3>{{ $head->name }}</h3>
                <p class="designation">{{ $head->designation }}</p>
                @if(!empty($head->research_interests))
                  <p class="research">Research Interests: {{ $head->research_interests }}</p>
                @endif
                <a href="{{ route('teachers.show', $head) }}" class="faculty-btn">View Full Profile</a>
              </div>
            </div>
          </div>
        @endif

        <!-- Regular Faculty Grid -->
        <div class="faculty-grid">
          @foreach($others as $teacher)
            <div class="faculty-card">
              <img src="{{ $teacher->profile_image ?: 'https://via.placeholder.com/400x400?text=Profile' }}" alt="Faculty Member" class="faculty-image">
              <h4 class="faculty-name">{{ $teacher->name }}</h4>
              <p class="faculty-designation">{{ $teacher->designation }}</p>
              @if(!empty($teacher->research_interests))
                <p class="faculty-research">{{ $teacher->research_interests }}</p>
              @endif
              <a href="{{ route('teachers.show', $teacher) }}" class="faculty-btn">View Profile</a>
            </div>
          @endforeach
        </div>
        
        <div class="text-center mt-5">
          <a href="{{ route('teachers.index') }}" class="btn faculty-btn">View All Faculty Members</a>
        </div>
      </div>
    </div>
  </section>

  <section id="students" class="students-section">
    <div class="container">
      <div class="section-header">
        <h2>Students Information</h2>
        <p>Resources and information for current students</p>
      </div>
      <div class="row g-4">
        <div class="col-md-4">
          <div class="student-card">
            <i class="bi bi-people-fill"></i>
            <h4>Student Portal</h4>
            <p>Access academic records, course registration, and other student services.</p>
            <button class="btn faculty-btn">Access Portal</button>
          </div>
        </div>
        <div class="col-md-4">
          <div class="student-card">
            <i class="bi bi-book-half"></i>
            <h4>Academic Resources</h4>
            <p>Find course materials, syllabi, and academic calendars for your program.</p>
            <a href="{{ route('academic-resources.index') }}" class="btn faculty-btn">View Resources</a>
          </div>
        </div>
        <div class="col-md-4">
          <div class="student-card">
            <i class="bi bi-briefcase-fill"></i>
            <h4>Career Services</h4>
            <p>Explore internship opportunities, job placements, and career guidance.</p>
            <button class="btn faculty-btn">Learn More</button>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="notices" class="py-5">
    <div class="container">
      <div class="section-header">
        <h2>Latest Notices</h2>
        <p>Stay updated with important announcements</p>
      </div>
      <div class="row">
        <div class="col-lg-8 mx-auto">
          @forelse($notices as $notice)
            <div class="notice-item">
              <div class="notice-date">{{ optional($notice->created_at)->format('F j, Y') }}</div>
              <h5 class="notice-title">{{ $notice->title }}</h5>
              <p>
                {{ \Illuminate\Support\Str::limit(strip_tags($notice->content), 180) }}
                <a href="{{ route('notices.show', $notice) }}" class="text-primary fw-semibold ms-2">Read More</a>
              </p>
            </div>
          @empty
            <div class="notice-item">
              <div class="notice-date">{{ now()->format('F j, Y') }}</div>
              <h5 class="notice-title">No notices yet</h5>
              <p>
                Please check back later for updates from the department.
              </p>
            </div>
          @endforelse
        </div>
      </div>
      <div class="text-center mt-5">
        <a href="{{ route('notices.index') }}" class="btn faculty-btn">View All Notices</a>
      </div>
    </div>
  </section>

  <section id="contact" class="contact-section">
    <div class="container">
      <div class="section-header">
        <h2>Contact Us</h2>
        <p>Get in touch with the Department of CSE</p>
      </div>
      <div class="row g-5">
        <div class="col-lg-5 contact-info">
          <div class="mb-4">
            <h4>Department of Computer Science & Engineering</h4>
            <p>Khulna University of Engineering & Technology</p>
          </div>
          <div class="d-flex mb-4">
            <i class="bi bi-geo-alt-fill"></i>
            <div>
              <h5>Address</h5>
              <p>KUET Campus, Fulbarigate, Khulna-9203, Bangladesh</p>
            </div>
          </div>
          <div class="d-flex mb-4">
            <i class="bi bi-envelope-fill"></i>
            <div>
              <h5>Email</h5>
              <p>cse@kuet.ac.bd</p>
            </div>
          </div>
          <div class="d-flex">
            <i class="bi bi-telephone-fill"></i>
            <div>
              <h5>Phone</h5>
              <p>+880-XXX-XXXXXXX</p>
            </div>
          </div>
        </div>
        <div class="col-lg-7">
          <div class="contact-form">
            <h4>Send us a Message</h4>
            <form action="#" method="POST">
              <div class="row">
                <div class="col-md-6">
                  <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                </div>
                <div class="col-md-6">
                  <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                </div>
              </div>
              <textarea name="message" class="form-control" rows="5" placeholder="Your Message" required></textarea>
              <button type="submit" class="btn w-100">Send Message</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer>
    <div class="container">
      <div class="row g-4">
        <div class="col-lg-4 mb-4">
          <a href="#" class="footer-logo">KUET CSE</a>
          <p>The Department of Computer Science and Engineering at KUET is committed to excellence in education, research, and innovation in the field of computer science and engineering.</p>
          <div class="social-icons mt-4">
            <a href="#"><i class="bi bi-facebook"></i></a>
            <a href="#"><i class="bi bi-twitter"></i></a>
            <a href="#"><i class="bi bi-linkedin"></i></a>
            <a href="#"><i class="bi bi-youtube"></i></a>
          </div>
        </div>
        <div class="col-lg-2 col-md-6 mb-4">
          <div class="footer-links">
            <h5>Quick Links</h5>
            <ul>
              <li><a href="#">Home</a></li>
              <li><a href="#">About Us</a></li>
              <li><a href="#">Faculty</a></li>
              <li><a href="#">Students</a></li>
              <li><a href="#">Notices</a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
          <div class="footer-links">
            <h5>Academics</h5>
            <ul>
              <li><a href="#">Undergraduate Programs</a></li>
              <li><a href="#">Graduate Programs</a></li>
              <li><a href="#">Course Catalog</a></li>
              <li><a href="#">Academic Calendar</a></li>
              <li><a href="#">Research Areas</a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
          <div class="footer-links">
            <h5>Contact Info</h5>
            <ul>
              <li><i class="bi bi-geo-alt me-2"></i> KUET Campus, Khulna</li>
              <li><i class="bi bi-envelope me-2"></i> cse@kuet.ac.bd</li>
              <li><i class="bi bi-telephone me-2"></i> +880-XXX-XXXXXXX</li>
            </ul>
          </div>
        </div>
      </div>
      <div class="copyright">
        <p>&copy; 2023 Department of Computer Science & Engineering, KUET. All Rights Reserved.</p>
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/scrollreveal"></script>
  <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
  <script>
    const backToTopButton = document.querySelector('.back-to-top');
    
    window.addEventListener('scroll', () => {
      if (window.pageYOffset > 300) {
        backToTopButton.classList.add('active');
      } else {
        backToTopButton.classList.remove('active');
      }
      
      const navbar = document.querySelector('.navbar');
      if (window.pageYOffset > 50) {
        navbar.classList.add('scrolled');
      } else {
        navbar.classList.remove('scrolled');
      }
    });
    
    backToTopButton.addEventListener('click', (e) => {
      e.preventDefault();
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
    
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const targetId = this.getAttribute('href');
        if (targetId === '#') return;
        const targetElement = document.querySelector(targetId);
        if (targetElement) {
          window.scrollTo({
            top: targetElement.offsetTop - 80,
            behavior: 'smooth'
          });
        }
      });
    });

    const sr = ScrollReveal({
      distance: '60px',
      duration: 1500,
      delay: 200,
      reset: false,
    });

    sr.reveal('.hero h1, .section-header', { origin: 'top' });
    sr.reveal('.hero p, .hero-btn', { origin: 'bottom', delay: 300 });
    sr.reveal('.about-content', { origin: 'left' });
    sr.reveal('.about-img', { origin: 'right' });
    sr.reveal('.faculty-head-card', { origin: 'top' });
    sr.reveal('.faculty-card', { interval: 200, origin: 'bottom' });
    sr.reveal('.student-card', { interval: 200, origin: 'bottom' });
    sr.reveal('.notice-item', { interval: 150, origin: 'left' });
    sr.reveal('.contact-info', { origin: 'left' });
    sr.reveal('.contact-form', { origin: 'right' });

    const typed = new Typed('.typed-text', {
      strings: ["Excellence in Education", "Pioneering Research", "Fostering Innovation"],
      typeSpeed: 70,
      backSpeed: 50,
      backDelay: 2000,
      loop: true,
    });

    const sections = document.querySelectorAll('section[id]');
    window.addEventListener('scroll', () => {
      let scrollY = window.pageYOffset;
      sections.forEach(current => {
        const sectionHeight = current.offsetHeight;
        const sectionTop = current.offsetTop - 100;
        const sectionId = current.getAttribute('id');
        if (scrollY > sectionTop && scrollY <= sectionTop + sectionHeight) {
          document.querySelectorAll('.nav-link').forEach(link => {
            link.classList.remove('active');
          });
          const activeLink = document.querySelector('.nav-link[href*=' + sectionId + ']');
          if (activeLink) activeLink.classList.add('active');
        }
      });
    });
  </script>
</body>
</html>