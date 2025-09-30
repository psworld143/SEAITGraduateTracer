<?php
require_once 'db_conn.php';

// Fetch documents from the database
$sql = "SELECT document_type, availability_status, release_date, additional_instructions FROM documents";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>SEAIT Graduate Tracer</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="assets/img/logoseait.png" rel="icon">
    <link href="assets/img/logoseait.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">

    <style>
    :root {
        --primary-gradient: linear-gradient(135deg, #ff9a3f, #ff6f3f, #ff3f3f);
        --primary-color: #ff6f3f;
        --primary-light: #ff9a3f;
        --primary-dark: #ff3f3f;
        --text-dark: #2c3e50;
        --text-light: #ffffff;
        --bg-light: #ffffff;
        --bg-gray: #f8f9fa;
        --card-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        --card-hover-shadow: 0 15px 35px rgba(255, 111, 63, 0.2);
        --border-radius: 16px;
        --transition-speed: 0.3s;
        --section-padding: 80px 0;
        --card-padding: 30px;
        --grid-gap: 30px;
    }


    /* Header Styles */
    .header {
        background: var(--primary-gradient);
        padding: 15px 0;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
    }

    .header .logo .sitename,
    .header .navmenu a,
    .header .btn-getstarted {
        color: var(--text-light);
    }

    .header .navmenu a {
        font-weight: 500;
        padding: 8px 15px;
        transition: all var(--transition-speed) ease;
    }

    .header .navmenu a:hover,
    .header .navmenu .active {
        color: rgba(255, 255, 255, 0.9);
        transform: translateY(-2px);
    }

    .header .btn-getstarted {
        background: rgba(255, 255, 255, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.3);
        padding: 8px 20px;
        border-radius: 50px;
        transition: all var(--transition-speed) ease;
    }

    .header .btn-getstarted:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    /* Global Section Styles */
    .section {
        padding: var(--section-padding);
        position: relative;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .section-title {
        margin-bottom: 20px;
    }

    .section-title h2 {
        color: var(--primary-color);
        position: relative;
        padding-bottom: 15px;
        margin-bottom: 20px;
        font-size: 2.5rem;
    }

    .section-title h2::before,
    .section-title h2::after {
        content: '';
        position: absolute;
        bottom: 0;
        width: 50px;
        height: 3px;
        background: var(--primary-gradient);
        border-radius: 3px;
    }

    .section-title h2::before {
        left: 25%;
        transform: translateX(-50%);
    }

    .section-title h2::after {
        left: 75%;
        transform: translateX(-50%);
    }

    .section-title p {
        color: var(--text-dark);
        opacity: 0.8;
        max-width: 600px;
        margin: 0 auto;
        font-size: 1.1rem;
    }

    /* Container Adjustments */
    .container {
        max-width: 1400px;
        padding: 0 var(--grid-gap);
    }

    /* Grid System Optimization */
    .row {
        margin: 0 calc(-1 * var(--grid-gap));
    }

    .row>[class*="col-"] {
        padding: 0 var(--grid-gap);
    }

    /* Card Base Styles */
    .card {
        border: none;
        border-radius: var(--border-radius);
        box-shadow: var(--card-shadow);
        transition: all var(--transition-speed) ease;
        height: 100%;
        overflow: hidden;
        margin-bottom: var(--grid-gap);
        background: var(--bg-light);
        position: relative;
    }

    .card:hover {
        transform: translateY(-8px);
        box-shadow: var(--card-hover-shadow);
    }

    .card-body {
        padding: var(--card-padding);
        display: flex;
        flex-direction: column;
        position: relative;
        z-index: 1;
    }

    /* Document Card Specific */
    .document-card {
        height: 450px;
        border: 2px solid rgba(255, 111, 63, 0.1);
        background: linear-gradient(145deg, #ffffff, #f8f9fa);
    }

    .document-card .card-body {
        padding: 35px;
    }

    .document-icon {
        font-size: 3rem;
        margin-bottom: 1.5rem;
        color: var(--primary-color);
        transition: transform var(--transition-speed) ease;
    }

    .document-card:hover .document-icon {
        transform: scale(1.15) rotate(5deg);
    }

    .document-card .card-title {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        color: var(--text-dark);
    }

    .document-card .badge {
        font-size: 0.9rem;
        padding: 8px 16px;
        border-radius: 30px;
        margin-bottom: 1.5rem;
    }

    .document-hover-overlay {
        background: var(--primary-gradient);
        padding: 1.5rem;
        font-size: 1.1rem;
        font-weight: 500;
    }

    /* Job Card Specific */
    .job-card {
        height: 400px;
        background: linear-gradient(145deg, #ffffff, #f8f9fa);
    }

    .job-card .card-body {
        padding: 35px;
    }

    .job-card .company-logo {
        width: 100px;
        height: 100px;
        margin-bottom: 1.5rem;
        padding: 10px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    .job-card .card-title {
        font-size: 1.4rem;
        font-weight: 600;
        margin-bottom: 1rem;
        line-height: 1.3;
    }

    .job-card .card-title a {
        color: var(--text-dark);
        transition: color var(--transition-speed) ease;
    }

    .job-card:hover .card-title a {
        color: var(--primary-color);
    }

    .job-card .job-details {
        margin: 1.5rem 0;
    }

    .job-card .badge {
        font-size: 0.85rem;
        padding: 8px 16px;
        border-radius: 30px;
        margin-right: 8px;
        font-weight: 500;
    }

    /* News Card Specific */
    .news-card {
        height: 500px;
        background: linear-gradient(145deg, #ffffff, #f8f9fa);
    }

    .news-card .card-body {
        padding: 35px;
    }

    .news-card img.card-img-top {
        height: 250px;
        object-fit: cover;
        border-radius: var(--border-radius) var(--border-radius) 0 0;
        transition: transform var(--transition-speed) ease;
    }

    .news-card:hover img.card-img-top {
        transform: scale(1.08);
    }

    .news-card .card-title {
        font-size: 1.4rem;
        font-weight: 600;
        margin: 1.5rem 0;
        line-height: 1.3;
    }

    .news-card .card-title a {
        color: var(--text-dark);
        transition: color var(--transition-speed) ease;
    }

    .news-card:hover .card-title a {
        color: var(--primary-color);
    }

    .news-card .news-meta {
        margin-bottom: 1.5rem;
    }

    .news-card .badge {
        font-size: 0.85rem;
        padding: 8px 16px;
        border-radius: 30px;
        margin-right: 8px;
        font-weight: 500;
    }

    .news-card .card-text {
        font-size: 1rem;
        line-height: 1.6;
        color: var(--text-dark);
        opacity: 0.8;
    }

    .news-card .btn-outline-primary {
        border: 2px solid var(--primary-color);
        color: var(--primary-color);
        font-weight: 500;
        padding: 10px 20px;
        border-radius: 30px;
        transition: all var(--transition-speed) ease;
    }

    .news-card .btn-outline-primary:hover {
        background: var(--primary-gradient);
        border-color: transparent;
        transform: translateY(-2px);
    }

    /* Badge Styles Enhancement */
    .badge {
        padding: 8px 16px;
        font-weight: 500;
        border-radius: 30px;
        font-size: 0.85rem;
        letter-spacing: 0.3px;
    }

    .badge.bg-primary {
        background: var(--primary-gradient) !important;
        box-shadow: 0 4px 15px rgba(255, 111, 63, 0.2);
    }

    .badge.bg-success {
        background: var(--primary-gradient) !important;
        box-shadow: 0 4px 15px rgba(255, 111, 63, 0.2);
    }

    .badge.bg-warning {
        background: linear-gradient(135deg, #ffc107, #ff9800) !important;
        box-shadow: 0 4px 15px rgba(255, 152, 0, 0.2);
    }

    /* Modal Styles Enhancement */
    .modal-content {
        border: none;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .modal-header {
        background: var(--primary-gradient);
        color: white;
        border: none;
        padding: 1.5rem;
        position: relative;
    }

    .modal-header .modal-title {
        font-size: 1.5rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .modal-header .btn-close {
        filter: brightness(0) invert(1);
        opacity: 0.8;
        transition: all 0.3s ease;
    }

    .modal-header .btn-close:hover {
        opacity: 1;
        transform: rotate(90deg);
    }

    .modal-body {
        padding: 2rem;
    }

    .modal-footer {
        border-top: 1px solid rgba(0, 0, 0, 0.1);
        padding: 1.5rem;
    }

    /* Document Modal Specific */
    .document-modal .document-status {
        background: rgba(255, 111, 63, 0.1);
        padding: 1rem;
        border-radius: 12px;
        margin-bottom: 1.5rem;
    }

    .document-modal .document-status .badge {
        font-size: 0.9rem;
        padding: 0.5rem 1rem;
        border-radius: 30px;
    }

    .document-modal .document-date {
        background: rgba(0, 0, 0, 0.03);
        padding: 1rem;
        border-radius: 12px;
        margin-bottom: 1.5rem;
    }

    .document-modal .document-instructions {
        background: rgba(0, 0, 0, 0.03);
        padding: 1.5rem;
        border-radius: 12px;
    }

    /* Job Modal Specific */
    .job-modal .company-info {
        background: rgba(255, 111, 63, 0.1);
        padding: 1.5rem;
        border-radius: 12px;
        margin-bottom: 1.5rem;
    }

    .job-modal .job-details {
        background: rgba(0, 0, 0, 0.03);
        padding: 1.5rem;
        border-radius: 12px;
        margin-bottom: 1.5rem;
    }

    .job-modal .qualifications-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .job-modal .qualifications-list li {
        padding: 0.5rem 0;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    }

    .job-modal .qualifications-list li:last-child {
        border-bottom: none;
    }

    /* News Modal Specific */
    .news-modal .news-image {
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 1.5rem;
    }

    .news-modal .news-content {
        background: rgba(0, 0, 0, 0.03);
        padding: 1.5rem;
        border-radius: 12px;
        margin-bottom: 1.5rem;
    }

    .news-modal .news-meta {
        background: rgba(255, 111, 63, 0.1);
        padding: 1rem;
        border-radius: 12px;
        margin-top: 1.5rem;
    }

    /* Modal Buttons */
    .modal-footer .btn {
        padding: 0.75rem 1.5rem;
        border-radius: 30px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .modal-footer .btn-secondary {
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        color: #6c757d;
    }

    .modal-footer .btn-secondary:hover {
        background: #e9ecef;
        transform: translateY(-2px);
    }

    .modal-footer .btn-primary {
        background: var(--primary-gradient);
        border: none;
    }

    .modal-footer .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 111, 63, 0.3);
    }

    /* Carousel Styles */
    .carousel-control-prev,
    .carousel-control-next {
        width: 5%;
        opacity: 0.8;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-color: var(--primary-color);
        border-radius: 50%;
        padding: 1.5rem;
    }

    .carousel-indicators {
        margin-bottom: 0;
    }

    .carousel-indicators button {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background-color: var(--primary-color);
        opacity: 0.5;
        margin: 0 5px;
    }

    .carousel-indicators button.active {
        opacity: 1;
    }

    /* Button Styles */
    .btn-getstarted {
        background: var(--primary-gradient);
        border: none;
        padding: 8px 20px;
        border-radius: 50px;
        transition: all var(--transition-speed) ease;
    }

    .btn-getstarted:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 111, 63, 0.3);
    }

    .btn-primary {
        background: var(--primary-gradient);
        border: none;
    }

    .btn-primary:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 111, 63, 0.3);
    }

    /* Footer Styles */
    .footer {
        background: var(--bg-gray);
        border-top: 1px solid rgba(255, 111, 63, 0.1);
        padding: 40px 0;
    }

    .footer .sitename {
        color: var(--primary-color);
    }

    .footer .social-links a {
        color: var(--primary-color);
        transition: color var(--transition-speed) ease;
    }

    .footer .social-links a:hover {
        color: var(--primary-dark);
    }

    /* Scroll Top Button */
    .scroll-top {
        background: var(--primary-gradient);
        color: var(--text-light);
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all var(--transition-speed) ease;
    }

    .scroll-top:hover {
        background: var(--primary-dark);
        transform: translateY(-3px);
    }

    /* Responsive Adjustments */
    @media (max-width: 1200px) {
        :root {
            --section-padding: 60px 0;
            --card-padding: 25px;
            --grid-gap: 25px;
        }

        .document-card,
        .job-card,
        .news-card {
            height: auto;
            min-height: 350px;
        }

        .news-card img.card-img-top {
            height: 200px;
        }
    }

    @media (max-width: 768px) {
        :root {
            --section-padding: 40px 0;
            --card-padding: 20px;
            --grid-gap: 20px;
        }

        .card-body {
            padding: 20px;
        }

        .document-card .card-title,
        .job-card .card-title,
        .news-card .card-title {
            font-size: 1.2rem;
        }
    }

    /* Document Section Specific Styles */
    #documents .carousel {
        position: relative;
        padding: 0 60px;
    }

    #documents .carousel-inner {
        padding: 20px 0;
    }

    #documents .carousel-item {
        padding: 10px;
    }

    #documents .carousel-control-prev,
    #documents .carousel-control-next {
        width: 50px;
        height: 50px;
        background: var(--primary-gradient);
        border-radius: 50%;
        top: 50%;
        transform: translateY(-50%);
        opacity: 1;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transition: all var(--transition-speed) ease;
    }

    #documents .carousel-control-prev {
        left: 0;
    }

    #documents .carousel-control-next {
        right: 0;
    }

    #documents .carousel-control-prev:hover,
    #documents .carousel-control-next:hover {
        transform: translateY(-50%) scale(1.1);
        box-shadow: 0 6px 20px rgba(255, 111, 63, 0.2);
    }

    #documents .carousel-control-prev-icon,
    #documents .carousel-control-next-icon {
        width: 24px;
        height: 24px;
        background-color: transparent;
        padding: 0;
    }

    #documents .document-card {
        height: 450px;
        border: 2px solid rgba(255, 111, 63, 0.1);
        background: linear-gradient(145deg, #ffffff, #f8f9fa);
        margin: 15px;
        position: relative;
        z-index: 1;
    }

    #documents .document-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: var(--primary-gradient);
        opacity: 0;
        z-index: -1;
        transition: opacity var(--transition-speed) ease;
        border-radius: var(--border-radius);
    }

    #documents .document-card:hover {
        border-color: transparent;
        transform: translateY(-8px);
    }

    #documents .document-card:hover::before {
        opacity: 0.05;
    }

    #documents .document-card .card-body {
        padding: 35px;
        background: white;
        border-radius: var(--border-radius);
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    #documents .document-icon {
        font-size: 3.5rem;
        margin-bottom: 1.5rem;
        color: var(--primary-color);
        transition: all var(--transition-speed) ease;
        text-align: center;
    }

    #documents .document-card:hover .document-icon {
        transform: scale(1.15) rotate(5deg);
        color: var(--primary-dark);
    }

    #documents .document-card .card-title {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        color: var(--text-dark);
        text-align: center;
    }

    #documents .document-card .badge {
        font-size: 0.9rem;
        padding: 8px 16px;
        border-radius: 30px;
        margin-bottom: 1.5rem;
        align-self: center;
    }

    #documents .document-card .document-meta {
        margin-bottom: 1.5rem;
        text-align: center;
    }

    #documents .document-card .document-preview {
        flex-grow: 1;
        border-top: 1px solid rgba(0, 0, 0, 0.1);
        padding-top: 1.5rem;
        margin-top: auto;
    }

    #documents .document-card .document-preview p {
        font-size: 0.95rem;
        line-height: 1.6;
        color: var(--text-dark);
        opacity: 0.8;
        margin-bottom: 0;
    }

    #documents .document-hover-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: var(--primary-gradient);
        color: white;
        padding: 1.5rem;
        text-align: center;
        opacity: 0;
        transition: all var(--transition-speed) ease;
        border-radius: 0 0 var(--border-radius) var(--border-radius);
    }

    #documents .document-card:hover .document-hover-overlay {
        opacity: 1;
    }

    #documents .document-hover-overlay .view-details {
        font-size: 1.1rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    #documents .carousel-indicators {
        position: relative;
        margin-top: 30px;
    }

    #documents .carousel-indicators button {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background-color: var(--primary-color);
        opacity: 0.5;
        margin: 0 6px;
        transition: all var(--transition-speed) ease;
    }

    #documents .carousel-indicators button.active {
        opacity: 1;
        transform: scale(1.2);
    }

    /* Responsive adjustments for document section */
    @media (max-width: 1200px) {
        #documents .carousel {
            padding: 0 50px;
        }

        #documents .document-card {
            height: auto;
            min-height: 400px;
        }
    }

    @media (max-width: 768px) {
        #documents .carousel {
            padding: 0 40px;
        }

        #documents .carousel-control-prev,
        #documents .carousel-control-next {
            width: 40px;
            height: 40px;
        }

        #documents .document-card {
            margin: 10px;
        }

        #documents .document-card .card-body {
            padding: 25px;
        }
    }

    /* Statistics Section Styles */
    .stat-item {
        transition: all var(--transition-speed) ease;
        border: 1px solid rgba(255, 111, 63, 0.1);
    }

    .stat-item-doc {
        transition: all var(--transition-speed) ease;
        border: 1px solid rgba(255, 111, 63, 0.1);
        padding: 20px;
        border-radius: var(--border-radius);
        background: var(--bg-light);
        box-shadow: var(--card-shadow);
        transition: all var(--transition-speed) ease;
        min-width: 535px;
    }

    .stat-item:hover {
        transform: translateY(-5px);
        box-shadow: var(--card-shadow);
        border-color: var(--primary-color);
    }

    .stat-item i {
        color: var(--primary-color);
    }

    .stat-item h3 {
        font-size: 2rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
    }

    /* Vision & Mission Card Styles */
    .card {
        transition: all var(--transition-speed) ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: var(--card-hover-shadow) !important;
    }

    .card-title {
        color: var(--text-dark);
        font-weight: 600;
    }

    .card-title i {
        color: var(--primary-color);
    }

    /* Contact Section Enhancements */
    .info-item {
        padding: 20px;
        border-radius: var(--border-radius);
        background: var(--bg-light);
        box-shadow: var(--card-shadow);
        transition: all var(--transition-speed) ease;
        margin-bottom: 20px;
    }

    .info-item:hover {
        transform: translateY(-5px);
        box-shadow: var(--card-hover-shadow);
    }

    .info-item i {
        font-size: 2rem;
        color: var(--primary-color);
        margin-right: 20px;
    }

    .info-item h3 {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 5px;
        color: var(--text-dark);
    }

    .info-item p {
        margin-bottom: 0;
        color: var(--text-dark);
        opacity: 0.8;
    }

    .social-links .btn {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all var(--transition-speed) ease;
    }

    .social-links .btn:hover {
        background: var(--primary-gradient);
        color: white;
        transform: translateY(-3px);
    }

    /* Hero Section Enhancements */
    .hero-bg {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: -1;
        overflow: hidden;
    }

    .hero-bg::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to right, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.4));
        z-index: 1;
    }

    .hero-bg img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .hero .display-4 {
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }

    .hero .lead {
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
    }

    .btn-outline-light:hover {
        background: var(--primary-gradient);
        border-color: transparent;
    }

    /* Document Categories Styles */
    .document-categories .btn {
        border-radius: 30px;
        padding: 8px 20px;
        transition: all var(--transition-speed) ease;
    }

    .document-categories .btn:hover,
    .document-categories .btn.active {
        background: var(--primary-gradient);
        border-color: transparent;
        transform: translateY(-2px);
    }

    /* Job Search Styles */
    .job-search-wrapper {
        box-shadow: var(--card-shadow);
        border: 1px solid rgba(255, 111, 63, 0.1);
    }

    .job-search-wrapper .input-group-text,
    .job-search-wrapper .form-control,
    .job-search-wrapper .form-select {
        border-color: rgba(255, 111, 63, 0.2);
    }

    .job-search-wrapper .form-control:focus,
    .job-search-wrapper .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(255, 111, 63, 0.25);
    }

    /* News Categories Styles */
    .news-categories .btn {
        border-radius: 30px;
        padding: 8px 20px;
        transition: all var(--transition-speed) ease;
    }

    .news-categories .btn:hover,
    .news-categories .btn.active {
        background: var(--primary-gradient);
        border-color: transparent;
        transform: translateY(-2px);
    }

    /* Featured News Styles */
    .featured-news {
        box-shadow: var(--card-shadow);
        transition: all var(--transition-speed) ease;
    }

    .featured-news:hover {
        transform: translateY(-5px);
        box-shadow: var(--card-hover-shadow);
    }

    .featured-news-content {
        transition: all var(--transition-speed) ease;
    }

    .featured-news:hover .featured-news-content {
        background: linear-gradient(to top, rgba(0, 0, 0, 0.9), transparent) !important;
    }

    .featured-news .btn-light {
        transition: all var(--transition-speed) ease;
    }

    .featured-news .btn-light:hover {
        background: var(--primary-gradient);
        border-color: transparent;
        color: white;
    }

    /* Stats Item Enhancement */
    .stat-item {
        padding: 20px;
        border-radius: var(--border-radius);
        background: var(--bg-light);
        box-shadow: var(--card-shadow);
        transition: all var(--transition-speed) ease;
        min-width: 350px;
    }

    .stat-item:hover {
        transform: translateY(-5px);
        box-shadow: var(--card-hover-shadow);
    }

    .stat-item i {
        font-size: 2.5rem;
        margin-bottom: 1rem;
    }

    .stat-item h4 {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        color: var(--text-dark);
    }

    .stat-item p {
        color: var(--text-dark);
        opacity: 0.8;
        margin-bottom: 0;
    }

    /* Responsive Styles */
    @media (max-width: 1200px) {
        :root {
            --section-padding: 60px 0;
            --card-padding: 25px;
            --grid-gap: 25px;
        }

        .container {
            max-width: 100%;
            padding: 0 20px;
        }

        .document-card,
        .job-card,
        .news-card {
            height: auto;
            min-height: 350px;
        }

        .news-card img.card-img-top {
            height: 200px;
        }

        .hero .display-4 {
            font-size: 2.5rem;
        }

        .hero .lead {
            font-size: 1.1rem;
        }

        .section-title h2 {
            font-size: 2rem;
        }
    }

    @media (max-width: 992px) {
        .header .navmenu {
            position: fixed;
            top: 0;
            right: -100%;
            width: 300px;
            height: 100vh;
            background: var(--bg-light);
            padding: 80px 20px 20px;
            transition: 0.3s;
            z-index: 999;
        }

        .header .navmenu.active {
            right: 0;
        }

        .header .navmenu ul {
            flex-direction: column;
            padding: 0;
        }

        .header .navmenu ul li {
            margin: 10px 0;
        }

        .mobile-nav-toggle {
            display: block !important;
        }

        .hero .display-4 {
            font-size: 2.2rem;
        }

        .stat-item {
            margin-bottom: 20px;
        }

        .document-stats,
        .job-stats {
            flex-wrap: wrap;
            gap: 20px;
        }

        .document-categories,
        .news-categories {
            flex-wrap: wrap;
            gap: 10px;
        }

        .document-categories .btn,
        .news-categories .btn {
            font-size: 0.9rem;
            padding: 6px 15px;
        }
    }

    @media (max-width: 768px) {
        :root {
            --section-padding: 40px 0;
            --card-padding: 20px;
            --grid-gap: 20px;
        }

        .header {
            padding: 10px 0;
        }

        .header .logo .sitename {
            font-size: 1.2rem;
        }

        .hero {
            text-align: center;
        }

        .hero .display-4 {
            font-size: 2rem;
        }

        .hero .lead {
            font-size: 1rem;
        }

        .section-title h2 {
            font-size: 1.8rem;
        }

        .card-body {
            padding: 20px;
        }

        .document-card .card-title,
        .job-card .card-title,
        .news-card .card-title {
            font-size: 1.2rem;
        }

        .stat-item {
            width: 100%;
            margin-bottom: 15px;
        }

        .document-stats,
        .job-stats {
            flex-direction: column;
        }

        .document-categories,
        .news-categories {
            justify-content: center;
        }

        .document-categories .btn,
        .news-categories .btn {
            width: calc(50% - 10px);
            text-align: center;
        }

        .featured-news {
            margin-bottom: 30px;
        }

        .featured-news img {
            height: 300px;
        }

        .contact-form {
            margin-top: 30px;
        }

        .info-item {
            margin-bottom: 15px;
        }

        .social-links {
            justify-content: center;
        }
    }

    @media (max-width: 576px) {
        .header .logo img {
            height: 25px;
        }

        .header .logo .sitename {
            font-size: 1rem;
        }

        .hero .display-4 {
            font-size: 1.8rem;
        }

        .hero .lead {
            font-size: 0.9rem;
        }

        .section-title h2 {
            font-size: 1.5rem;
        }

        .document-card,
        .job-card,
        .news-card {
            min-height: 300px;
        }

        .document-categories .btn,
        .news-categories .btn {
            width: 100%;
        }

        .stat-item h4 {
            font-size: 1.5rem;
        }

        .featured-news img {
            height: 250px;
        }

        .modal-dialog {
            margin: 10px;
        }

        .modal-body {
            padding: 15px;
        }

        .footer {
            text-align: center;
        }

        .footer .social-links {
            margin-top: 15px;
        }
    }

    /* Additional Responsive Fixes */
    @media (max-width: 992px) {
        .job-search-wrapper .input-group {
            flex-direction: column;
        }

        .job-search-wrapper .input-group>* {
            width: 100%;
            margin-bottom: 10px;
        }

        .job-search-wrapper .btn {
            width: 100%;
        }
    }

    @media (max-width: 768px) {

        .carousel-control-prev,
        .carousel-control-next {
            width: 40px;
            height: 40px;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            width: 20px;
            height: 20px;
        }

        .modal-dialog {
            max-width: 95%;
        }
    }

    /* Fix for mobile navigation */
    .mobile-nav-toggle {
        display: none;
        position: fixed;
        right: 20px;
        top: 20px;
        z-index: 9999;
        background: var(--primary-color);
        color: white;
        border: none;
        padding: 10px;
        border-radius: 50%;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .mobile-nav-toggle:hover {
        background: var(--primary-dark);
    }

    /* Fix for sticky header on mobile */
    @media (max-width: 992px) {
        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            background: var(--primary-gradient);
        }

        .main {
            padding-top: 70px;
        }
    }

    /* Fix for document cards on mobile */
    @media (max-width: 576px) {
        .document-card .card-body {
            padding: 15px;
        }

        .document-icon {
            font-size: 2.5rem;
        }

        .document-card .card-title {
            font-size: 1.1rem;
        }

        .document-hover-overlay {
            padding: 1rem;
        }
    }

    /* Fix for job cards on mobile */
    @media (max-width: 576px) {
        .job-card .card-body {
            padding: 15px;
        }

        .job-card .company-logo {
            width: 50px;
            height: 50px;
        }

        .job-card .card-title {
            font-size: 1.1rem;
        }
    }

    /* Fix for news cards on mobile */
    @media (max-width: 576px) {
        .news-card .card-body {
            padding: 15px;
        }

        .news-card img.card-img-top {
            height: 180px;
        }

        .news-card .card-title {
            font-size: 1.1rem;
        }
    }

    /* Fix for contact section on mobile */
    @media (max-width: 768px) {
        .contact .info-item {
            padding: 15px;
        }

        .contact .info-item i {
            font-size: 1.5rem;
        }

        .contact .info-item h3 {
            font-size: 1.1rem;
        }

        .contact form {
            padding: 20px;
        }
    }

    /* Fix for footer on mobile */
    @media (max-width: 576px) {
        .footer {
            padding: 30px 0;
        }

        .footer .copyright {
            font-size: 0.9rem;
        }

        .footer .social-links a {
            width: 35px;
            height: 35px;
            font-size: 1rem;
        }
    }

    /* Map Container Styles */
    .map-container {
        position: relative;
        width: 100%;
        height: 100%;
        min-height: 450px;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .map-container iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: none;
    }

    /* Responsive Map Styles */
    @media (max-width: 992px) {
        .map-container {
            margin-top: 30px;
            min-height: 400px;
        }
    }

    @media (max-width: 768px) {
        .map-container {
            min-height: 350px;
        }
    }

    @media (max-width: 576px) {
        .map-container {
            min-height: 300px;
        }
    }

    .steps-timeline {
        position: relative;
        padding: 20px 0;
    }

    .step-item {
        padding: 20px;
        height: 100%;
    }

    .step-number {
        width: 50px;
        height: 50px;
        background: var(--primary-gradient);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        font-weight: bold;
        margin: 0 auto 20px;
        position: relative;
        z-index: 2;
    }

    .step-content {
        background: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        height: 100%;
        transition: transform 0.3s ease;
    }

    .step-content:hover {
        transform: translateY(-5px);
    }

    .step-content h4 {
        color: var(--primary-color);
        margin-bottom: 15px;
        font-weight: 600;
    }

    .step-content p {
        color: var(--text-dark);
        margin-bottom: 10px;
        font-size: 0.95rem;
    }

    .step-content ul {
        list-style: none;
        padding-left: 0;
        margin-bottom: 0;
    }

    .step-content ul li {
        position: relative;
        padding-left: 20px;
        margin-bottom: 8px;
        font-size: 0.95rem;
    }

    .step-content ul li:before {
        content: "•";
        color: var(--primary-color);
        position: absolute;
        left: 0;
    }

    .step-connector {
        position: absolute;
        top: 25px;
        right: -50%;
        width: 100%;
        height: 2px;
        background: var(--primary-gradient);
        z-index: 1;
    }

    @media (max-width: 768px) {
        .step-connector {
            display: none;
        }

        .step-item {
            margin-bottom: 30px;
        }
    }
    </style>

</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a href="index.html" class="logo d-flex align-items-center me-auto">
                <img src="assets/img/logoseait.png" alt="Logo 1" height="30" class="d-inline-block align-text-top me-2">
                <h1 class="sitename">AlumniGraduateTracer</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#hero" class="active">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#documents">Documents</a></li>
                    <li><a href="#job-posting">Job Posting</a></li>
                    <li><a href="#news">News</a></li>
                    <li><a href="#survey">Survey</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <a class="btn-getstarted" href="index2.php">Login</a>

        </div>
    </header>

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section position-relative">
            <div class="hero-bg">
                <img src="assets/img/alumni.jpg" alt="">
            </div>
            <div class="container position-relative">
                <div class="row gy-4">
                    <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                        <h1 class="display-4 fw-bold text-white mb-4" data-aos="fade-up">
                            Welcome to SEAIT Alumni Portal
                        </h1>
                        <p class="lead text-white mb-4" data-aos="fade-up" data-aos-delay="100">
                            Help Us Measure Graduate Success — Take the Tracer Survey!
                        </p>
                        <div class="d-flex gap-3" data-aos="fade-up" data-aos-delay="200">
                            <a href="#documents" class="btn btn-primary btn-lg">Get Started</a>
                            <a href="#about" class="btn btn-outline-light btn-lg">Learn More</a>
                            <a href="#survey" class="btn btn-outline-light btn-lg"><i class="bi bi-question-circle me-2"></i>How to?</a>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- /Hero Section -->

        <!-- About Section -->
        <section id="about" class="about section">

            <!-- Section Title -->
            <div class="container section-title text-center" data-aos="fade-up">
                <h2>About Us</h2>
            </div><!-- End Section Title -->

            <div class="container d-flex justify-content-center">
                <div class="row gy-5 justify-content-center w-100">

                    <div class="col-xl-10" data-aos="fade-up" data-aos-delay="200">
                        <div class="row gy-4 justify-content-center">

                            <div class="content-section" style="text-align: justify;">
                                <p>The South East Asian Institute of Technology, Inc. (SEAIT) offers free education
                                    across all college programs, supported by various government sectors and NGOs.</p>
                            </div>

                            <div class="content-section" style="text-align: justify;">
                                <h3 class="text-center">Our History</h3>
                                <p>South East Asian Institute of Technology, Inc., affectionately known as SEAIT, began
                                    its journey in February 2006. Unlike a typical foundation story, ours unfolded like
                                    a dramatic play, with all the elements of a grand performance. The curtains opened
                                    slowly, revealing our humble beginnings.</p>

                                <p>Initially occupying a rented space at a Shell Gasoline station in Tupi, SEAIT catered
                                    to a small population of vocational students. The founders, Mr. Reynaldo S. Tamayo
                                    and Mrs. Rochelle P. Tamayo, faced numerous challenges, particularly regarding the
                                    learning environment. Despite these obstacles, they remained steadfast in their
                                    commitment to providing quality education.</p>

                                <p>SEAIT began by offering technical and vocational courses, such as Computer
                                    Programming NC IV and Computer Hardware Servicing NC II. A pivotal moment came when
                                    the Technical Education Skills Development Authority (TESDA) granted permission to
                                    offer Hotel and Restaurant Management.</p>

                                <p>In June 2016, we received government recognition from the Department of Education to
                                    operate K-12 programs, including kindergarten, junior high, and senior high school,
                                    which saw steady growth in enrollment.</p>

                                <p>This year, we proudly broaden our offerings with new degree programs:</p>
                                <ul class="program-list" style="text-align: justify; padding-left: 1.5rem;">
                                    <li>Bachelor of Science in Tourism Management (BSTM)</li>
                                    <li>Bachelor of Early Childhood Education (BECE)</li>
                                    <li>Bachelor of Science in Accounting Information Systems (BSAIS)</li>
                                    <li>Bachelor of Science in Public Administration (BSPA)</li>
                                    <li>Bachelor of Science in Fisheries (BSF)</li>
                                </ul>

                                <p>From the dedicated efforts of the Tamayo family, SEAIT has evolved into a vibrant
                                    community of administrators, faculty, students, and local partners, all united in
                                    the pursuit of education and meaningful contributions to society. Our story
                                    continues to unfold, driven by our commitment to growth and excellence.</p>
                            </div>

                            <!-- Vision & Mission -->
                            <div class="row mt-5" data-aos="fade-up">
                                <div class="col-md-6 mb-4">
                                    <div class="card h-100 border-0 shadow-sm">
                                        <div class="card-body p-4">
                                            <h4 class="card-title mb-4">
                                                <i class="bi bi-eye text-primary me-2"></i>Our Vision
                                            </h4>
                                            <p class="card-text">
                                                A premier institution that provides quality education and globally
                                                empowered individuals.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="card h-100 border-0 shadow-sm">
                                        <div class="card-body p-4">
                                            <h4 class="card-title mb-4">
                                                <i class="bi bi-bullseye text-primary me-2"></i>Our Mission
                                            </h4>
                                            <p class="card-text">
                                                To produce competent, community-oriented, and globally competitive
                                                individual through holistic education.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </section><!-- /About Section -->


        <!-- Documents Section -->
        <section id="documents" class="services section">

            <!-- Section Title -->
            <div class="container section-title text-center" data-aos="fade-up">
                <h2>Documents</h2>
                <p>Access important documents and resources here.</p>
            </div><!-- End Section Title -->

            <!-- Document Categories -->
            <div class="container mb-5" data-aos="fade-up">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="document-categories d-flex justify-content-center gap-3 flex-wrap">
                            <?php
                            // Get unique document types
                            $sql = "SELECT DISTINCT document_type FROM documents";
                            $result = $conn->query($sql);
                            ?>
                            <button class="btn btn-outline-primary active">All Documents</button>
                            <?php
                            if ($result && $result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<button class="btn btn-outline-primary">' . htmlspecialchars($row['document_type']) . '</button>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Document Stats -->
            <div class="container mb-2" data-aos="fade-up">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="document-stats d-flex justify-content-around text-center">
                            <?php
                            // Get total documents
                            $sql = "SELECT COUNT(*) as total FROM documents";
                            $result = $conn->query($sql);
                            $total_docs = $result ? $result->fetch_assoc()['total'] : 0;

                            // Get recent documents (last 30 days)
                            $sql = "SELECT COUNT(*) as recent FROM documents WHERE release_date >= DATE_SUB(NOW(), INTERVAL 30 DAY)";
                            $result = $conn->query($sql);
                            $recent_docs = $result ? $result->fetch_assoc()['recent'] : 0;
                            ?>
                            <div class="stat-item-doc">
                                <i class="bi bi-file-earmark-text text-primary"></i>
                                <h4><?php echo $total_docs; ?></h4>
                                <p>Total Documents</p>
                            </div>
                            <div class="stat-item-doc">
                                <i class="bi bi-clock-history text-primary"></i>
                                <h4><?php echo $recent_docs; ?></h4>
                                <p>Recent Documents</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div id="documentsCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php 
                        $items_per_slide = 3;
                        $sql = "SELECT * FROM documents";
                        $result = $conn->query($sql);
                        $total_items = $result ? $result->num_rows : 0;
                        $total_slides = ceil($total_items / $items_per_slide);
                        
                        for ($slide = 0; $slide < $total_slides; $slide++): 
                            $is_active = $slide === 0 ? 'active' : '';
                        ?>
                        <div class="carousel-item <?php echo $is_active; ?>">
                            <div class="row gy-4 justify-content-center">
                                <?php
                                    $count = 0;
                                    if ($result) {
                                        $result->data_seek($slide * $items_per_slide);
                                        while ($count < $items_per_slide && ($row = $result->fetch_assoc())):
                                    ?>
                                <div class="col-xl-4 col-md-6 d-flex" data-aos="fade-up"
                                    data-aos-delay="<?php echo ($count + 1) * 100; ?>">
                                    <div class="document-card card h-100 w-100 border-0 shadow-lg" role="button"
                                        data-bs-toggle="modal"
                                        data-bs-target="#documentModal<?php echo $slide . $count; ?>">
                                        <div class="card-body p-4">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="document-icon me-2">
                                                    <i class="bi bi-file-earmark-text fs-1 text-primary"></i>
                                                </div>
                                                <h4 class="card-title h5 mb-0">
                                                    <?php echo htmlspecialchars($row['document_type']); ?>
                                                </h4>
                                            </div>

                                            <div class="d-flex align-items-center mb-3">
                                                <span
                                                    class="badge <?php echo $row['availability_status'] === 'Available' ? 'bg-success' : 'bg-warning'; ?>">
                                                    <?php echo htmlspecialchars($row['availability_status']); ?>
                                                </span>
                                            </div>

                                            <div class="document-meta mb-3">
                                                <small class="text-muted">
                                                    <i class="bi bi-calendar-event me-1"></i>
                                                    <?php echo date("m/d/Y", strtotime($row['release_date'])); ?>
                                                </small>
                                            </div>

                                            <div class="document-preview mt-3">
                                                <p class="text-muted small mb-0"
                                                    style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                    <?php 
                                                            $preview = substr(strip_tags($row['additional_instructions']), 0, 100);
                                                            echo htmlspecialchars($preview) . (strlen($preview) > 100 ? '...' : '');
                                                            ?>
                                                </p>
                                            </div>

                                            <div class="document-hover-overlay">
                                                <span class="view-details">
                                                    <i class="bi bi-eye me-1"></i> View Details
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Document Modal -->
                                <div class="modal fade" id="documentModal<?php echo $slide . $count; ?>" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" style="max-width: 600px;">
                                        <div class="modal-content document-modal">
                                            <div class="modal-header">
                                                <h5 class="modal-title">
                                                    <i class="bi bi-file-earmark-text"></i>
                                                    <?php echo htmlspecialchars($row['document_type']); ?>
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="document-status">
                                                    <h6 class="fw-bold mb-2">Status</h6>
                                                    <span
                                                        class="badge <?php echo $row['availability_status'] === 'Available' ? 'bg-success' : 'bg-warning'; ?>">
                                                        <?php echo htmlspecialchars($row['availability_status']); ?>
                                                    </span>
                                                </div>

                                                <div class="document-date">
                                                    <h6 class="fw-bold mb-2">Release Date</h6>
                                                    <p class="mb-0">
                                                        <i class="bi bi-calendar-event me-2"></i>
                                                        <?php echo date("F j, Y", strtotime($row['release_date'])); ?>
                                                    </p>
                                                </div>

                                                <div class="document-instructions">
                                                    <h6 class="fw-bold mb-3">Additional Instructions</h6>
                                                    <div class="instructions-content">
                                                        <?php echo nl2br(htmlspecialchars($row['additional_instructions'])); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <?php if ($row['availability_status'] === 'Available'): ?>
                                                <button type="button" class="btn btn-primary">
                                                    <i class="bi bi-download me-2"></i>Request Document
                                                </button>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php 
                                        $count++;
                                        endwhile;
                                    }
                                    ?>
                            </div>
                        </div>
                        <?php endfor; ?>
                    </div>

                    <!-- Carousel Controls -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#documentsCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#documentsCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>

                    <div class="carousel-indicators position-relative mt-4">
                        <?php for ($i = 0; $i < $total_slides; $i++): ?>
                        <button type="button" data-bs-target="#documentsCarousel" data-bs-slide-to="<?php echo $i; ?>"
                            <?php echo $i === 0 ? 'class="active" aria-current="true"' : ''; ?>
                            aria-label="Slide <?php echo $i + 1; ?>">
                        </button>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>

        </section><!-- /Documents Section -->

        <!-- Job Posting Section -->
        <section id="job-posting" class="portfolio section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Job Posting</h2>
                <p>Find the latest job opportunities that match your skills and interests.</p>
            </div><!-- End Section Title -->

            <!-- Job Search and Filters -->
            <div class="container mb-5" data-aos="fade-up">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="job-search-wrapper p-4 bg-light rounded-4">
                            <div class="row g-3">
                                <div class="col-md-5">
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0">
                                            <i class="bi bi-search"></i>
                                        </span>
                                        <input type="text" class="form-control border-start-0"
                                            placeholder="Search jobs...">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-select">
                                        <option selected>Job Type</option>
                                        <?php
                                        // Get unique job types
                                        $sql = "SELECT DISTINCT job_type FROM job_postings WHERE status = 'active'";
                                        $result = $conn->query($sql);
                                        if ($result && $result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo '<option>' . htmlspecialchars($row['job_type']) . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-select">
                                        <option selected>Location</option>
                                        <?php
                                        // Get unique locations
                                        $sql = "SELECT DISTINCT job_location FROM job_postings WHERE status = 'active'";
                                        $result = $conn->query($sql);
                                        if ($result && $result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo '<option>' . htmlspecialchars($row['job_location']) . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <button class="btn btn-primary w-100">
                                        <i class="bi bi-funnel"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Job Stats -->
            <div class="container mb-5" data-aos="fade-up">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="job-stats d-flex justify-content-around text-center">
                            <?php
                            // Get total active jobs
                            $sql = "SELECT COUNT(*) as total FROM job_postings WHERE status = 'active'";
                            $result = $conn->query($sql);
                            $total_jobs = $result->fetch_assoc()['total'];

                            // Get unique companies
                            $sql = "SELECT COUNT(DISTINCT company_name) as companies FROM job_postings WHERE status = 'active'";
                            $result = $conn->query($sql);
                            $total_companies = $result->fetch_assoc()['companies'];

                            // Get jobs posted in last 30 days
                            $sql = "SELECT COUNT(*) as recent FROM job_postings WHERE status = 'active' AND created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)";
                            $result = $conn->query($sql);
                            $recent_jobs = $result->fetch_assoc()['recent'];
                            ?>
                            <div class="stat-item">
                                <i class="bi bi-briefcase text-primary"></i>
                                <h4><?php echo $total_jobs; ?></h4>
                                <p>Active Jobs</p>
                            </div>
                            <div class="stat-item">
                                <i class="bi bi-building text-primary"></i>
                                <h4><?php echo $total_companies; ?></h4>
                                <p>Companies</p>
                            </div>
                            <div class="stat-item">
                                <i class="bi bi-clock-history text-primary"></i>
                                <h4><?php echo $recent_jobs; ?></h4>
                                <p>New Jobs (30 days)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container" style="max-height: 800px; overflow-y: auto;">
                <div class="row gy-4 justify-content-center">
                    <?php
                    $sql = "SELECT company_name, company_logo, job_location, job_title, job_description, qualifications, application_deadline, contact_info, status FROM job_postings WHERE status = 'active' ORDER BY id DESC";
                    $result = $conn->query($sql);

                    if ($result && $result->num_rows > 0):
                        $count = 0;
                        while ($row = $result->fetch_assoc()):
                            $count++;
                    ?>
                    <div class="col-xl-4 col-md-6 d-flex" data-aos="fade-up"
                        data-aos-delay="<?php echo $count * 100; ?>">
                        <div class="card job-card"
                            style="width: 100%; border: none; border-radius: 12px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); transition: transform 0.3s ease; height: 300px;">
                            <div class="card-body"
                                style="padding: 25px; height: 100%; display: flex; flex-direction: column;">
                                <div class="d-flex align-items-center mb-3" style="min-height: 80px;">
                                    <?php if (!empty($row["company_logo"])): ?>
                                    <div
                                        style="width: 60px; height: 60px; margin-right: 15px; display: flex; align-items: center; justify-content: center;">
                                        <img src="admin/uploads/<?php echo htmlspecialchars($row["company_logo"]); ?>"
                                            alt="<?php echo htmlspecialchars($row["company_name"]); ?> Logo"
                                            style="max-width: 100%; max-height: 100%; object-fit: contain; border-radius: 8px;">
                                    </div>
                                    <?php endif; ?>
                                    <div class="flex-grow-1" style="min-width: 0;">
                                        <h4 class="card-title mb-1"
                                            style="height: 24px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                            <a href="#" class="stretched-link text-decoration-none"
                                                data-bs-toggle="modal" data-bs-target="#jobModal<?php echo $count; ?>">
                                                <?php echo htmlspecialchars($row["job_title"]); ?>
                                            </a>
                                        </h4>
                                        <p class="text-muted mb-0"
                                            style="height: 20px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                            <?php echo htmlspecialchars($row["company_name"]); ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="job-details mb-3" style="height: 30px;">
                                    <span class="badge bg-primary me-2">Full Time</span>
                                    <span class="badge bg-info me-2">On-site</span>
                                </div>
                                <p class="card-text mb-3"
                                    style="height: 60px; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; text-overflow: ellipsis;">
                                    <?php 
                                    $description = strip_tags($row["job_description"]);
                                    echo htmlspecialchars($description);
                                    ?>
                                </p>
                                <div class="mt-auto">
                                    <div class="d-flex justify-content-between align-items-center"
                                        style="height: 24px;">
                                        <small class="text-muted"
                                            style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: 45%;">
                                            <i class="bi bi-geo-alt"></i>
                                            <?php echo htmlspecialchars($row["job_location"]); ?>
                                        </small>
                                        <small class="text-muted"
                                            style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: 45%;">
                                            <i class="bi bi-clock"></i> Deadline:
                                            <?php echo htmlspecialchars($row["application_deadline"]); ?>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Job Details Modal -->
                    <div class="modal fade" id="jobModal<?php echo $count; ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content job-modal">
                                <div class="modal-header">
                                    <h5 class="modal-title">
                                        <i class="bi bi-briefcase"></i>
                                        <?php echo htmlspecialchars($row["job_title"]); ?>
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="company-info">
                                        <div class="row align-items-center">
                                            <div class="col-md-8">
                                                <h4 class="mb-3"><?php echo htmlspecialchars($row["company_name"]); ?>
                                                </h4>
                                                <div class="d-flex align-items-center mb-2">
                                                    <i class="bi bi-geo-alt me-2"></i>
                                                    <span><?php echo htmlspecialchars($row["job_location"]); ?></span>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <i class="bi bi-clock me-2"></i>
                                                    <span>Application Deadline:
                                                        <?php echo date("F j, Y", strtotime($row["application_deadline"])); ?></span>
                                                </div>
                                            </div>
                                            <?php if (!empty($row["company_logo"])): ?>
                                            <div class="col-md-4 text-end">
                                                <div class="company-logo-wrapper"
                                                    style="width: 120px; height: 120px; margin-left: auto;">
                                                    <img src="admin/uploads/<?php echo htmlspecialchars($row["company_logo"]); ?>"
                                                        alt="<?php echo htmlspecialchars($row["company_name"]); ?> Logo"
                                                        class="img-fluid rounded-3"
                                                        style="width: 100%; height: 100%; object-fit: contain;">
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="job-details">
                                        <h5 class="border-bottom pb-2 mb-3">Job Description</h5>
                                        <div class="description-content">
                                            <?php echo nl2br(htmlspecialchars($row["job_description"])); ?>
                                        </div>
                                    </div>

                                    <div class="job-details">
                                        <h5 class="border-bottom pb-2 mb-3">Qualifications</h5>
                                        <ul class="qualifications-list">
                                            <?php
                                            $qualificationsList = array_filter(array_map('trim', explode("\n", $row["qualifications"])));
                                            if (!empty($qualificationsList)):
                                                foreach ($qualificationsList as $qualification):
                                            ?>
                                            <li>
                                                <i class="bi bi-check-circle-fill text-success me-2"></i>
                                                <?php echo htmlspecialchars($qualification); ?>
                                            </li>
                                            <?php
                                                endforeach;
                                            else:
                                            ?>
                                            <li class="text-muted">No specific qualifications listed.</li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>

                                    <div class="job-details">
                                        <h5 class="border-bottom pb-2 mb-3">Contact Information</h5>
                                        <div class="contact-content">
                                            <?php echo nl2br(htmlspecialchars($row["contact_info"])); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">
                                        <i class="bi bi-send me-2"></i>Apply Now
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php 
                        endwhile;
                    else:
                    ?>
                    <div class="col-12 text-center">
                        <div class="no-jobs">
                            <i class="bi bi-briefcase" style="font-size: 3rem; color: #adb5bd;"></i>
                            <p class="h5 mt-3">No job postings available at the moment.</p>
                            <p class="text-muted">Please check back later for new opportunities.</p>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </section><!-- /Job Posting Section -->

        <!-- News Section -->
        <section id="news" class="team section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Latest News</h2>
                <p>Stay informed with the latest updates and announcements.</p>
            </div><!-- End Section Title -->

            <!-- News Categories -->
            <div class="container mb-5" data-aos="fade-up">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="news-categories d-flex justify-content-center gap-3 flex-wrap">
                            <?php
                            // Get unique news categories
                            $sql = "SELECT DISTINCT category FROM news";
                            $result = $conn->query($sql);
                            ?>
                            <button class="btn btn-outline-primary active">All News</button>
                            <?php
                            if ($result && $result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<button class="btn btn-outline-primary">' . htmlspecialchars($row['category']) . '</button>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Featured News -->
            <div class="container mb-5" data-aos="fade-up">
                <div class="row">
                    <div class="col-12">
                        <?php
                        // Get featured news
                        $sql = "SELECT * FROM news WHERE is_featured = 1 ORDER BY created_at DESC LIMIT 1";
                        $result = $conn->query($sql);
                        if ($result && $result->num_rows > 0) {
                            $featured = $result->fetch_assoc();
                            ?>
                        <div class="featured-news position-relative rounded-4 overflow-hidden">
                            <img src="<?php echo htmlspecialchars($featured['image']); ?>"
                                alt="<?php echo htmlspecialchars($featured['title']); ?>" class="w-100"
                                style="height: 400px; object-fit: cover;">
                            <div class="featured-news-content position-absolute bottom-0 start-0 end-0 p-4 text-white"
                                style="background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);">
                                <span
                                    class="badge bg-primary mb-2"><?php echo htmlspecialchars($featured['category']); ?></span>
                                <h3 class="mb-2"><?php echo htmlspecialchars($featured['title']); ?></h3>
                                <p class="mb-3">
                                    <?php echo htmlspecialchars(substr(strip_tags($featured['description']), 0, 150)) . '...'; ?>
                                </p>
                                <a href="#" class="btn btn-light" data-bs-toggle="modal"
                                    data-bs-target="#newsModal-<?php echo $featured['id']; ?>">Read More</a>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row gy-4">
                    <?php
                    // Fetch news from database
                    $sql = "SELECT id, title, description, image, created_at FROM news ORDER BY created_at DESC LIMIT 4";
                    $result = $conn->query($sql);

                    if ($result && $result->num_rows > 0):
                        while ($row = $result->fetch_assoc()):
                            // Format the date
                            $date = date("F j, Y", strtotime($row['created_at']));
                            // Get time difference
                            $time_diff = time() - strtotime($row['created_at']);
                            $time_ago = '';
                            
                            if ($time_diff < 3600) {
                                $time_ago = floor($time_diff / 60) . ' minutes ago';
                            } elseif ($time_diff < 86400) {
                                $time_ago = floor($time_diff / 3600) . ' hours ago';
                            } elseif ($time_diff < 604800) {
                                $time_ago = floor($time_diff / 86400) . ' days ago';
                            } else {
                                $time_ago = $date;
                            }
                    ?>
                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                        <div class="card news-card h-100"
                            style="width: 100%; border: none; border-radius: 12px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); transition: transform 0.3s ease;">
                            <?php if (!empty($row['image'])): ?>
                            <div style="height: 200px; overflow: hidden;">
                                <img src="admin/uploads/<?php echo htmlspecialchars($row['image']); ?>"
                                    class="card-img-top" alt="News Image"
                                    style="width: 100%; height: 100%; object-fit: cover; border-radius: 12px 12px 0 0;">
                            </div>
                            <?php endif; ?>
                            <div class="card-body d-flex flex-column" style="padding: 25px;">
                                <div class="news-meta mb-2">
                                    <span class="badge bg-primary me-2">News</span>
                                    <small class="text-muted"><i class="bi bi-clock"></i>
                                        <?php echo $time_ago; ?></small>
                                </div>
                                <h4 class="card-title"
                                    style="height: 48px; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                    <a href="#" class="stretched-link text-decoration-none" data-bs-toggle="modal"
                                        data-bs-target="#newsModal-<?php echo $row['id']; ?>">
                                        <?php echo htmlspecialchars($row['title']); ?>
                                    </a>
                                </h4>
                                <p class="card-text flex-grow-1"
                                    style="height: 72px; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;">
                                    <?php 
                                    $description = strip_tags($row['description']);
                                    echo htmlspecialchars($description);
                                    ?>
                                </p>
                                <div class="mt-3">
                                    <button class="btn btn-outline-primary btn-sm w-100" data-bs-toggle="modal"
                                        data-bs-target="#newsModal-<?php echo $row['id']; ?>">
                                        Read More
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- News Modal -->
                    <div class="modal fade" id="newsModal-<?php echo $row['id']; ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content news-modal">
                                <div class="modal-header">
                                    <h5 class="modal-title">
                                        <i class="bi bi-newspaper"></i>
                                        <?php echo htmlspecialchars($row['title']); ?>
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <?php if (!empty($row['image'])): ?>
                                    <div class="news-image">
                                        <img src="admin/uploads/<?php echo htmlspecialchars($row['image']); ?>"
                                            class="img-fluid w-100" alt="News Image"
                                            style="max-height: 400px; object-fit: cover;">
                                    </div>
                                    <?php endif; ?>

                                    <div class="news-content">
                                        <?php
                                        $description = strip_tags($row['description']);
                                        $formattedDescription = nl2br(htmlspecialchars($description));
                                        $paragraphs = explode("\n", $formattedDescription);
                                        
                                        foreach ($paragraphs as $paragraph) {
                                            if (trim($paragraph) !== '') {
                                                echo "<p class='mb-3' style='text-align: justify;'>" . $paragraph . "</p>";
                                            }
                                        }
                                        ?>
                                    </div>

                                    <div class="news-meta">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="news-timestamp text-muted">
                                                <small><i class="bi bi-clock me-2"></i>Posted on
                                                    <?php echo $date; ?></small>
                                            </div>
                                            <div class="news-share">
                                                <button class="btn btn-sm btn-outline-primary me-2">
                                                    <i class="bi bi-share me-1"></i>Share
                                                </button>
                                                <button class="btn btn-sm btn-outline-secondary">
                                                    <i class="bi bi-bookmark me-1"></i>Save
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php 
                        endwhile;
                    else:
                    ?>
                    <div class="col-12 text-center">
                        <div class="no-news">
                            <i class="bi bi-newspaper" style="font-size: 3rem; color: #adb5bd;"></i>
                            <p class="h5 mt-3">No news available at the moment.</p>
                            <p class="text-muted">Please check back later for updates.</p>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </section><!-- /News Section -->

        <!-- Survey Section -->
        <section id="survey" class="survey section">
            <div class="container section-title text-center" data-aos="fade-up">
                <h2>Alumni Tracer Survey</h2>
                <p>Help us measure graduate success by completing the tracer survey</p>
            </div>

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="survey-instructions" data-aos="fade-up">
                            <h3 class="text-center mb-5">🎓 How to Take the Alumni Tracer Survey</h3>
                            
                            <div class="process-timeline">
                                <!-- First Row -->
                                <div class="process-row">
                                    <div class="process-step">
                                        <div class="process-number">1</div>
                                        <div class="process-content">
                                            <h4>Log In</h4>
                                            <p>If your account was pre-registered by the school, simply go to the login page and enter your credentials (email and password).</p>
                                        </div>
                                    </div>
                                    <div class="process-step">
                                        <div class="process-number">2</div>
                                        <div class="process-content">
                                            <h4>Sign Up</h4>
                                            <p>If you don't have an account yet:</p>
                                            <ul>
                                                <li>Click "Sign Up" on the login page</li>
                                                <li>Fill out the required details</li>
                                                <li>Submit the form</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="process-step">
                                        <div class="process-number">3</div>
                                        <div class="process-content">
                                            <h4>Email Confirmation</h4>
                                            <p>Check your Gmail inbox for confirmation email.</p>
                                            <p class="text-warning"><i class="bi bi-exclamation-triangle me-1"></i>Check Spam/Junk folder if not found</p>
                                            <p>Click the confirmation link to activate your account</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Second Row -->
                                <div class="process-row">
                                    <div class="process-step">
                                        <div class="process-number">4</div>
                                        <div class="process-content">
                                            <h4>Access Survey</h4>
                                            <p>Once your account is activated:</p>
                                            <ul>
                                                <li>Log in again</li>
                                                <li>Go to Survey Section</li>
                                                <li>Fill out the Alumni Tracer Form</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="process-step">
                                        <div class="process-number">5</div>
                                        <div class="process-content">
                                            <h4>Submit</h4>
                                            <p>Review your answers and click Submit to officially complete the survey.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center mt-5">
                                <a href="index2.php" class="btn btn-primary btn-lg">
                                    <i class="bi bi-box-arrow-in-right me-2"></i>Proceed to Login
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <style>
            .process-timeline {
                position: relative;
                padding: 40px 0;
            }

            .process-row {
                display: flex;
                justify-content: space-between;
                position: relative;
                margin-bottom: 40px;
            }

            .process-row:last-child {
                margin-bottom: 0;
            }

            .process-step {
                flex: 1;
                position: relative;
                padding: 0 20px;
                text-align: center;
            }

            .process-step:not(:last-child)::after {
                content: '';
                position: absolute;
                top: 25px;
                right: -50%;
                width: 100%;
                height: 2px;
                background: var(--primary-gradient);
                z-index: 1;
            }

            .process-number {
                width: 50px;
                height: 50px;
                background: var(--primary-gradient);
                color: white;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.5rem;
                font-weight: bold;
                margin: 0 auto 20px;
                position: relative;
                z-index: 2;
            }

            .process-content {
                padding: 0 15px;
            }

            .process-content h4 {
                color: var(--primary-color);
                margin-bottom: 15px;
                font-weight: 600;
            }

            .process-content p {
                color: var(--text-dark);
                margin-bottom: 10px;
                font-size: 0.95rem;
            }

            .process-content ul {
                list-style: none;
                padding-left: 0;
                margin-bottom: 0;
                text-align: left;
            }

            .process-content ul li {
                position: relative;
                padding-left: 20px;
                margin-bottom: 8px;
                font-size: 0.95rem;
            }

            .process-content ul li:before {
                content: "•";
                color: var(--primary-color);
                position: absolute;
                left: 0;
            }

            @media (max-width: 768px) {
                .process-row {
                    flex-direction: column;
                }

                .process-step {
                    margin-bottom: 30px;
                }

                .process-step:not(:last-child)::after {
                    display: none;
                }

                .process-content {
                    padding: 0;
                }
            }
            </style>
        </section><!-- /Survey Section -->

        <!-- Contact Section -->
        <section id="contact" class="contact section">
            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Contact Us</h2>
                <p>Get in touch with us for inquiries about admissions, programs, and alumni services</p>
            </div><!-- End Section Title -->

            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row gy-4">
                    <!-- Contact Info -->
                    <div class="col-lg-6">
                        <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
                            <i class="bi bi-geo-alt flex-shrink-0"></i>
                            <div>
                                <h3>Address</h3>
                                <p>Nat'l Highway, Crossing Rubber, Tupi, South Cotabato 9505</p>
                            </div>
                        </div>

                        <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                            <i class="bi bi-telephone flex-shrink-0"></i>
                            <div>
                                <h3>Call Us</h3>
                                <p>(083) 226 1602</p>
                            </div>
                        </div>

                        <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                            <i class="bi bi-envelope flex-shrink-0"></i>
                            <div>
                                <h3>Email Us</h3>
                                <p>seaitinc@gmail.com</p>
                            </div>
                        </div>

                        <!-- Additional Contact Info -->
                        <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="500">
                            <i class="bi bi-clock flex-shrink-0"></i>
                            <div>
                                <h3>Office Hours</h3>
                                <p>Monday - Friday: 8:00 AM - 5:00 PM<br>
                                    Saturday: 8:00 AM - 12:00 PM</p>
                            </div>
                        </div>

                        <!-- Social Media Links -->
                        <div class="social-links mt-4" data-aos="fade-up" data-aos-delay="600">
                            <h3>Follow Us</h3>
                            <div class="d-flex gap-3 mt-3">
                                <a href="https://www.facebook.com/codecollectiveitsolutions"
                                    class="btn btn-outline-primary rounded-circle">
                                    <i class="bi bi-facebook"></i>
                                </a>
                                <a href="#" class="btn btn-outline-primary rounded-circle">
                                    <i class="bi bi-twitter-x"></i>
                                </a>
                                <a href="#" class="btn btn-outline-primary rounded-circle">
                                    <i class="bi bi-instagram"></i>
                                </a>
                                <a href="#" class="btn btn-outline-primary rounded-circle">
                                    <i class="bi bi-linkedin"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Map -->
                    <div class="col-lg-6">
                        <div class="map-container" data-aos="fade-up" data-aos-delay="200">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.6666666666665!2d124.933333!3d6.333333!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x32f8c2c8c2c8c2c8%3A0x32f8c2c8c2c8c2c8!2sSouth%20East%20Asian%20Institute%20of%20Technology!5e0!3m2!1sen!2sph!4v1234567890!5m2!1sen!2sph"
                                width="100%" height="450"
                                style="border:0; border-radius: 12px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);"
                                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- /Contact Section -->

    </main>

    <footer id="footer" class="footer">

        <div class="container">
            <div class="social-links d-flex justify-content-center">
                <a href=""><i class="bi bi-twitter-x"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
            </div>
            <div class="credits">
                Designed by CodeCollective IT Solution</a>
            </div>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>