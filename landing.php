<?php
$teamImagePaths = glob(__DIR__ . '/images/*.{jpg,jpeg,png,webp,JPG,JPEG,PNG,WEBP}', GLOB_BRACE);
if ($teamImagePaths === false) {
	$teamImagePaths = [];
}
$teamImagePaths = array_filter($teamImagePaths, static function ($imagePath) {
	$imageName = basename($imagePath);
	return !(preg_match('/\.png$/i', $imageName) && preg_match('/michell/i', $imageName));
});
natsort($teamImagePaths);
$teamImagePaths = array_values($teamImagePaths);

$homeStripImagePaths = array_values(array_filter($teamImagePaths, static function ($imagePath) {
	$imageName = basename($imagePath);
	return stripos($imageName, 'michelle') === false && stripos($imageName, 'michell') === false;
}));
if ($homeStripImagePaths === []) {
	$homeStripImagePaths = $teamImagePaths;
}

function pickMemberImage(array $imagePaths, array $needles): ?string
{
	foreach ($imagePaths as $imagePath) {
		$fileName = basename($imagePath);
		$matched = true;
		foreach ($needles as $needle) {
			if (stripos($fileName, $needle) === false) {
				$matched = false;
				break;
			}
		}
		if ($matched) {
			return $fileName;
		}
	}
	return isset($imagePaths[0]) ? basename($imagePaths[0]) : null;
}

$memberCards = [
	[
		'badge' => 'LEADERSHIP',
		'name' => 'Rucia Reyes',
		'role' => 'Vice President for Internal Affairs',
		'teaser' => 'Keeping EXPLICIT connected and aligned',
		'detail' => 'Rucia is the force that keeps EXPLICIT connected and aligned. Through her leadership, she creates an environment where collaboration thrives and every member feels valued. Her vision brings teams together toward common goals.',
		'image' => pickMemberImage($teamImagePaths, ['rucia']),
		'points' => [
			'Strengthened internal communication and coordination to ensure efficient operations',
			'Boosted member engagement through inclusive and collaborative initiatives',
			'Implemented organized systems to improve productivity and accountability',
		],
	],
	[
		'badge' => 'COMMUNICATION',
		'name' => 'Roxanne Regulacion',
		'role' => 'Secretary',
		'teaser' => 'Keeping EXPLICIT structured and informed',
		'detail' => 'Roxanne keeps EXPLICIT organized and informed through clear records and timely communication. Her discipline ensures smooth coordination and that every member stays aligned with key updates and plans.',
		'image' => pickMemberImage($teamImagePaths, ['regulacion']),
		'points' => [
			'Maintained accurate records and documentation, ensuring organized and accessible information',
			'Ensured timely dissemination of announcements and meeting minutes to all members',
			'Improved administrative efficiency through systematic filing and record-keeping systems',
		],
	],
	[
		'badge' => 'ACCOUNTABILITY',
		'name' => 'Irish Arabaca',
		'role' => 'Auditor',
		'teaser' => 'Promoting transparency and trust',
		'detail' => 'Irish champions transparency by carefully reviewing finances and monitoring records with consistency. Her commitment to accountability strengthens trust and keeps the organization financially responsible.',
		'image' => pickMemberImage($teamImagePaths, ['arabaca']),
		'points' => [
			'Ensured transparency by accurately monitoring and reviewing the organization\'s finances',
			'Maintained organized financial records and conducted regular audits for accountability',
			'Promoted responsible fund management by verifying expenses and ensuring proper documentation',
		],
	],
	[
		'badge' => 'FINANCE',
		'name' => 'Jhayciel Santiago',
		'role' => 'Treasurer',
		'teaser' => 'Transforming resources into opportunities',
		'detail' => 'Jhayciel transforms financial resources into opportunities by managing funds with care and transparency. Her budgeting and monitoring ensure that projects are supported effectively and responsibly.',
		'image' => pickMemberImage($teamImagePaths, ['santiago']),
		'points' => [
			'Managed and allocated funds responsibly to support organizational activities',
			'Maintained accurate financial records and prepared transparent financial reports',
			'Ensured proper budgeting and monitoring of expenses to promote financial accountability',
		],
	],
];

$mentorCards = [
	[
		'name' => 'Charisse Adorador Nethercott',
		'role' => 'Mentor',
		'focus' => 'Discrete Structures 1 • Data Structures and Algorithms',
		'description' => 'Guiding students through logic, problem-solving, and critical thinking, she builds strong foundations in computing and prepares them for real-world challenges.',
		'image' => pickMemberImage($teamImagePaths, ['charisse']),
	],
	[
		'name' => 'Jonabelle Lavape',
		'role' => 'Mentor',
		'focus' => 'BSIT Free Elective 1',
		'description' => 'Through encouragement and support, she empowers students to explore their interests, develop their skills, and grow with confidence.',
		'image' => pickMemberImage($teamImagePaths, ['jonabelle']),
	],
];

$herStoryImage = pickMemberImage($teamImagePaths, ['michelle']);
if ($herStoryImage === null) {
	$herStoryImage = pickMemberImage($teamImagePaths, ['michell']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Explicitly Her</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
	<style>
		:root {
			--bg-top: #1a0a2e;
			--bg-mid: #160826;
			--bg-bottom: #0f0520;
			--nav-height: 66px;
			--team-title-offset: 22px;
			--team-card-height: 430px;
			--team-avatar-ring: 3px;
			--team-avatar-glow: 0 8px 18px rgba(26, 6, 42, 0.28);
			--nav-bg: rgba(20, 8, 38, 0.85);
			--nav-border: rgba(169, 106, 198, 0.22);
			--card-bg: rgba(255, 255, 255, 0.06);
			--card-stroke: rgba(255, 255, 255, 0.10);
			--title: #c084fc;
			--text-main: #b07fe0;
			--text-sub: rgba(192, 132, 252, 0.70);
			--logo: #a855f7;
			--shadow: rgba(16, 1, 25, 0.58);
			--shell-width: min(860px, 92vw);
		}

		* {
			box-sizing: border-box;
			margin: 0;
			padding: 0;
		}

		body {
			min-height: 100vh;
			overflow-x: hidden;
			font-family: "Poppins", sans-serif;
			color: #fff;
			background: radial-gradient(ellipse at 60% 50%, #6b1065 0%, #3b0764 30%, #1a0a2e 70%, #0f0520 100%);
		}

		nav {
			position: fixed;
			top: 0;
			left: 0;
			right: 0;
			height: 66px;
			padding: 0 28px;
			display: flex;
			align-items: center;
			justify-content: space-between;
			background: var(--nav-bg);
			border-bottom: 1px solid var(--nav-border);
			backdrop-filter: blur(8px);
			z-index: 10;
		}

		.brand {
			display: inline-flex;
			align-items: center;
			gap: 8px;
			color: var(--logo);
			text-decoration: none;
			font-weight: 700;
			font-size: 22px;
			line-height: 1;
		}

		.brand .icon {
			font-size: 18px;
			line-height: 1;
		}

		.menu {
			list-style: none;
			display: flex;
			align-items: center;
			gap: 28px;
		}

		.menu a {
			color: rgba(255, 255, 255, 0.70);
			text-decoration: none;
			font-size: 13px;
			font-weight: 600;
			transition: color .2s ease;
		}

		.menu a:hover {
			color: #efc8ff;
		}

		.hero {
			min-height: 100vh;
			padding-top: 84px;
			padding-bottom: 68px;
			display: grid;
			place-items: center;
			position: relative;
			overflow: hidden;
			background:
				radial-gradient(circle at 20% 24%, rgba(107, 26, 107, 0.28), transparent 33%),
				radial-gradient(circle at 82% 74%, rgba(122, 31, 122, 0.26), transparent 35%);
			border-bottom: 1px solid rgba(188, 129, 221, 0.26);
		}

		.hero-carousel {
			position: absolute;
			left: 50%;
			width: 100vw;
			top: 52%;
			transform: translate(-50%, -50%);
			z-index: 0;
			pointer-events: none;
			opacity: 0.55;
			overflow: hidden;
		}

		.carousel-track {
			display: flex;
			align-items: center;
			gap: 16px;
			width: max-content;
			min-width: 300%;
			padding: 16px 0;
			animation: carousel-move 48s linear infinite;
		}

		@keyframes carousel-move {
			from { transform: translateX(0); }
			to { transform: translateX(-33.3333%); }
		}

		.carousel-item {
			width: 136px;
			height: 224px;
			border-radius: 8px;
			overflow: hidden;
			transform: skewX(-14deg);
			box-shadow: 0 10px 22px rgba(7, 1, 14, 0.35);
			border: 1px solid rgba(246, 223, 255, 0.18);
			background: rgba(255, 255, 255, 0.06);
			flex: 0 0 auto;
		}

		.carousel-item img {
			width: 122%;
			height: 100%;
			object-fit: cover;
			transform: skewX(14deg) translateX(-8%);
			display: block;
			filter: saturate(0.9) brightness(0.9);
		}

		.about-section {
			min-height: 100vh;
			padding: 84px 26px 68px;
			display: grid;
			place-items: center;
			position: relative;
			background:
				radial-gradient(circle at 20% 24%, rgba(107, 26, 107, 0.28), transparent 33%),
				radial-gradient(circle at 82% 74%, rgba(122, 31, 122, 0.26), transparent 35%);
			border-top: 1px solid rgba(188, 129, 221, 0.26);
			border-bottom: 1px solid rgba(188, 129, 221, 0.26);
		}

		.home-strip {
			margin-top: 34px;
		}

		.home-strip .strip-box {
			width: min(1380px, 98vw);
			border: 0;
			background: transparent;
			box-shadow: none;
			padding: 0;
		}

		.strip-box {
			width: var(--shell-width);
			margin: 0 auto;
			border-radius: 22px;
			border: 1px solid rgba(198, 128, 230, 0.16);
			background: rgba(255, 255, 255, 0.03);
			box-shadow: 0 12px 28px rgba(16, 1, 25, 0.34);
			padding: 14px 10px 10px;
		}

		.strip-wrap {
			width: 100%;
			margin: 0 auto;
			display: flex;
			justify-content: center;
			gap: 12px;
			flex-wrap: wrap;
			overflow: visible;
			padding-bottom: 0;
		}

		.strip-item {
			width: 92px;
			height: 156px;
			transform: skewX(-16deg);
			border-radius: 5px;
			overflow: hidden;
			flex: 0 0 auto;
			box-shadow: 0 12px 20px rgba(0, 0, 0, 0.2);
		}

		.strip-item img {
			width: 120%;
			height: 100%;
			object-fit: cover;
			transform: skewX(16deg) translateX(-8%);
			display: block;
		}

		.about-section::before {
			content: "";
			position: absolute;
			top: 0;
			left: 0;
			right: 0;
			height: 1px;
			background: linear-gradient(90deg, transparent 0%, rgba(215, 154, 245, 0.68) 50%, transparent 100%);
		}

		.about-card {
			width: var(--shell-width);
			margin: 0 auto;
			border-radius: 24px;
			border: 1px solid rgba(205, 132, 236, 0.24);
			background: linear-gradient(160deg, rgba(81, 40, 101, 0.82), rgba(72, 32, 93, 0.8));
			box-shadow: 0 30px 66px rgba(19, 2, 30, 0.5), 0 0 34px rgba(132, 62, 170, 0.26);
			padding: 30px 36px 34px;
		}

		.about-title {
    		font-size: 36px;
    		font-weight: 800;

    		background: linear-gradient(
        	120deg,
     	 	#a855f7 0%,
            #ffffff 30%,
            #c084fc 60%,
            #a855f7 100%
			
	);

    background-size: 200% auto;
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;

    animation: shine 3s linear infinite;

    text-align: center;

    text-shadow:
        0 0 10px rgba(168, 85, 247, 0.6),
        0 0 20px rgba(168, 85, 247, 0.4);
}
		.about-text {
			color: #efe2f8;
			font-size: clamp(16px, 1.35vw, 26px);
			font-weight: 500;
			line-height: 1.36;
			max-width: 860px;
		}

		.team-section {
			padding: calc(var(--nav-height) + 28px) 26px 52px;
			position: relative;
			display: block;
			background:
				radial-gradient(circle at 18% 18%, rgba(107, 26, 107, 0.22), transparent 36%),
				radial-gradient(circle at 82% 72%, rgba(122, 31, 122, 0.18), transparent 36%),
				linear-gradient(180deg, #17082a 0%, #130721 100%);
			border-top: 1px solid rgba(188, 129, 221, 0.26);
			border-bottom: 1px solid rgba(188, 129, 221, 0.26);
		}

		.team-section::before {
			content: "";
			position: absolute;
			top: 0;
			left: 0;
			right: 0;
			height: 1px;
			background: linear-gradient(90deg, transparent 0%, rgba(215, 154, 245, 0.68) 50%, transparent 100%);
		}

		.team-title {
			text-align: center;
			color: #e9c4ff;
			font-size: clamp(30px, 3vw, 44px);
			font-weight: 800;
			line-height: 1.1;
			margin-bottom: 18px;
			letter-spacing: 0.01em;
		}

		.info-grid {
			width: min(1140px, 94vw);
			margin: 0 auto;
			display: grid;
			grid-template-columns: repeat(2, minmax(0, 1fr));
			gap: 14px;
		}

		.info-card {
			display: grid;
			grid-template-columns: 108px 1fr;
			gap: 16px;
			align-items: start;
			border-radius: 16px;
			border: 1px solid rgba(225, 190, 247, 0.24);
			background: rgba(53, 23, 74, 0.72);
			box-shadow: 0 10px 26px rgba(9, 2, 16, 0.28);
			padding: 16px;
			min-height: var(--team-card-height);
			cursor: pointer;
			transition: border-color .2s ease, box-shadow .2s ease, transform .2s ease;
		}

		.info-card:hover {
			transform: translateY(-2px);
			box-shadow: 0 14px 30px rgba(9, 2, 16, 0.35);
			border-color: rgba(237, 204, 255, 0.4);
		}

		.info-badge {
			grid-column: 1 / -1;
			display: inline-block;
			padding: 4px 12px;
			border-radius: 999px;
			background: rgba(220, 175, 248, 0.14);
			border: 1px solid rgba(242, 216, 255, 0.2);
			color: #efccff;
			font-size: 11px;
			letter-spacing: 0.04em;
			font-weight: 600;
			margin-bottom: 2px;
			width: fit-content;
		}

		.info-avatar {
			width: 108px;
			height: 108px;
			border-radius: 50%;
			overflow: hidden;
			margin: 0;
			border: var(--team-avatar-ring) solid rgba(176, 99, 216, 0.82);
			box-shadow: var(--team-avatar-glow), inset 0 0 0 1px rgba(255, 255, 255, 0.12);
		}

		.info-avatar img {
			width: 100%;
			height: 100%;
			object-fit: cover;
		}

		.info-name {
			color: #ddb0ff;
			font-size: clamp(23px, 1.7vw, 30px);
			font-weight: 700;
			line-height: 1.12;
			margin-bottom: 6px;
		}

		.info-role {
			color: #efceff;
			font-size: clamp(16px, 1.25vw, 20px);
			font-weight: 600;
			margin-bottom: 8px;
		}

		.info-teaser {
			color: rgba(241, 222, 251, 0.84);
			font-size: clamp(14px, 1vw, 16px);
			font-weight: 500;
			line-height: 1.45;
			margin-bottom: 10px;
		}

		.info-more {
			color: rgba(208, 151, 245, 0.92);
			font-size: clamp(12px, 0.9vw, 14px);
			font-weight: 600;
			margin-top: auto;
		}

		.info-copy {
			display: flex;
			flex-direction: column;
			min-height: 108px;
		}

		.info-list {
			list-style: none;
			display: grid;
			gap: 10px;
			margin-top: 8px;
		}

		.info-list li {
			color: #f1defb;
			font-size: clamp(16px, 1.2vw, 22px);
			font-weight: 600;
			line-height: 1.35;
		}

		.member-modal {
			position: fixed;
			inset: 0;
			display: none;
			align-items: center;
			justify-content: center;
			padding: 24px;
			background: rgba(8, 2, 18, 0.82);
			backdrop-filter: blur(10px);
			-webkit-backdrop-filter: blur(10px);
			z-index: 120;
		}

		.member-modal.open {
			display: flex;
		}

		.modal-panel {
			position: relative;
			width: min(560px, 95vw);
			max-height: min(90vh, 860px);
			overflow: auto;
			border-radius: 22px;
			padding: 28px 30px 28px;
			border: 1px solid rgba(180, 120, 230, 0.28);
			background: rgba(22, 8, 38, 0.88);
			backdrop-filter: blur(12px);
			-webkit-backdrop-filter: blur(12px);
			box-shadow: 0 28px 60px rgba(6, 1, 14, 0.72), 0 0 40px rgba(100, 40, 150, 0.18);
			text-align: center;
		}

		.modal-close {
			position: absolute;
			top: 12px;
			right: 12px;
			width: 28px;
			height: 28px;
			border-radius: 50%;
			border: 1.5px solid rgba(201, 143, 236, 0.7);
			background: rgba(40, 14, 60, 0.7);
			color: #dea6ff;
			font-size: 20px;
			line-height: 1;
			cursor: pointer;
			display: flex;
			align-items: center;
			justify-content: center;
			padding: 0;
			transition: background .2s;
		}

		.modal-close:hover {
			background: rgba(80, 30, 110, 0.8);
		}

		.modal-top {
			display: flex;
			flex-direction: column;
			align-items: center;
			text-align: center;
			margin-bottom: 14px;
			gap: 0;
		}

		.modal-top .info-badge {
			font-size: 11px;
			margin-bottom: 14px;
			letter-spacing: 0.08em;
		}

		.modal-top .info-avatar {
			width: 130px;
			height: 130px;
			margin-bottom: 12px;
			border: 3px solid rgba(168, 85, 247, 0.85);
			box-shadow: 0 0 0 4px rgba(100, 30, 160, 0.25), 0 8px 22px rgba(12, 2, 22, 0.45);
		}

		.modal-top .info-name {
			font-size: clamp(28px, 3.5vw, 38px);
			color: #d066ff;
			font-weight: 800;
			margin-bottom: 4px;
		}

		.modal-top .info-role {
			font-size: clamp(15px, 1.5vw, 18px);
			color: #b87fe0;
			font-weight: 600;
			margin-bottom: 0;
		}

		.modal-intro {
			color: rgba(238, 220, 252, 0.88);
			font-size: clamp(13px, 1.05vw, 15px);
			line-height: 1.55;
			margin: 12px 0 14px;
			text-align: left;
		}

		.modal-subtitle {
			color: #c060f5;
			font-size: clamp(15px, 1.3vw, 18px);
			font-weight: 700;
			margin: 4px 0 8px;
			text-align: left;
		}

		.modal-points {
			list-style: none;
			display: grid;
			gap: 8px;
			margin-top: 4px;
			text-align: left;
		}

		.modal-points li {
			position: relative;
			padding-left: 22px;
			color: #eedeff;
			font-size: clamp(13px, 1.02vw, 15px);
			line-height: 1.45;
		}

		.modal-points li::before {
			content: "✩";
			position: absolute;
			left: 0;
			top: 0;
			color: #c060f5;
			font-size: 15px;
		}

		.ideas-section {
			min-height: 100vh;
			padding: calc(var(--nav-height) + 28px) 26px 52px;
			position: relative;
			background:
				radial-gradient(circle at 10% 12%, rgba(177, 112, 216, 0.18), transparent 34%),
				radial-gradient(circle at 88% 84%, rgba(136, 72, 184, 0.22), transparent 34%),
				linear-gradient(180deg, #1b0c2f 0%, #1a0a2e 55%, #150828 100%);
			border-top: 1px solid rgba(188, 129, 221, 0.26);
			border-bottom: 1px solid rgba(188, 129, 221, 0.26);
		}

		.ideas-decor {
			position: absolute;
			inset: 0;
			pointer-events: none;
			z-index: 0;
		}

		.ideas-decor span {
			position: absolute;
			font-size: 18px;
			opacity: 0.7;
		}

		.ideas-decor .s1 { top: 80px; left: 8%; }
		.ideas-decor .s2 { top: 56px; right: 18%; }
		.ideas-decor .s3 { top: 146px; right: 10%; font-size: 24px; }
		.ideas-decor .s4 { top: 180px; left: 24%; font-size: 14px; }

		.ideas-wrap {
			width: min(1180px, 96vw);
			margin: 0 auto;
			position: relative;
			z-index: 1;
		}

		.ideas-head {
			text-align: center;
			margin-bottom: 34px;
		}

		.ideas-title {
			font-family: "Playfair Display", serif;
			color: #ca8bff;
			font-size: clamp(46px, 4.8vw, 74px);
			font-weight: 700;
			line-height: 1.08;
			margin-bottom: 8px;
		}

		.ideas-subtitle {
			color: #bd8be9;
			font-size: clamp(16px, 1.4vw, 24px);
			font-weight: 500;
		}

		.ideas-grid {
			display: grid;
			grid-template-columns: repeat(2, minmax(0, 1fr));
			gap: 24px;
		}

		.idea-card {
			position: relative;
			min-height: 430px;
			border-radius: 24px;
			overflow: hidden;
			border: 1px solid rgba(243, 220, 255, 0.25);
			box-shadow: 0 18px 40px rgba(11, 2, 20, 0.35);
		}
		
		.idea-card:hover {
   			box-shadow: 
        	0 0 25px rgba(168, 85, 247, 0.7),
        	0 0 50px rgba(168, 85, 247, 0.5),
        	0 18px 40px rgba(11, 2, 20, 0.35);
    	transform: translateY(-4px);
    	transition: 0.3s ease;
		}


		.idea-photo {
			position: absolute;
			inset: 0;
			width: 100%;
			height: 100%;
			object-fit: cover;
			filter: brightness(0.72) saturate(0.9);
		}

		.idea-card::before {
			content: "";
			position: absolute;
			inset: 0;
			background: linear-gradient(180deg, rgba(101, 49, 134, 0.5) 0%, rgba(73, 30, 104, 0.7) 48%, rgba(95, 44, 128, 0.9) 100%);
		}

		.idea-card::after {
			content: "";
			position: absolute;
			inset: 0;
			background: radial-gradient(circle at 78% 84%, rgba(189, 109, 235, 0.28), transparent 44%);
		}

		.idea-content {
			position: absolute;
			left: 0;
			right: 0;
			bottom: 0;
			padding: 22px 22px 22px;
			z-index: 1;
			text-shadow: 0 2px 10px rgba(17, 4, 28, 0.42);
		}

		.idea-tag {
			color: rgba(241, 227, 252, 0.88);
			font-size: 12px;
			letter-spacing: 0.06em;
			font-weight: 700;
			margin-bottom: 10px;
		}

		.idea-name {
			font-family: "Playfair Display", serif;
			color: #f0d9ff;
			font-size: clamp(30px, 2.5vw, 42px);
			line-height: 1.04;
			margin-bottom: 6px;
		}

		.idea-role {
			color: #f2ddff;
			font-size: clamp(13px, 1vw, 17px);
			font-weight: 600;
			margin-bottom: 6px;
		}

		.idea-desc {
			color: rgba(244, 231, 255, 0.92);
			font-size: clamp(13px, 0.98vw, 16px);
			line-height: 1.45;
			max-width: 96%;
		}

		.idea-corner {
			position: absolute;
			top: 12px;
			left: 14px;
			font-size: 24px;
			z-index: 1;
			filter: drop-shadow(0 4px 8px rgba(41, 16, 59, 0.45));
		}

		.awards-section {
			min-height: 100vh;
			padding: calc(var(--nav-height) + 34px) 26px 56px;
			background:
				radial-gradient(circle at 14% 18%, rgba(107, 26, 107, 0.24), transparent 38%),
				radial-gradient(circle at 88% 72%, rgba(122, 31, 122, 0.22), transparent 36%),
				linear-gradient(180deg, #1a0a2e 0%, #160826 46%, #0f0520 100%);
			border-top: 1px solid rgba(188, 129, 221, 0.2);
		}

		.awards-wrap {
			width: min(1040px, 94vw);
			margin: 0 auto;
		}

		.awards-head {
			text-align: center;
			margin-bottom: 34px;
		}

		.awards-title-row {
			display: inline-block;
		}

		.awards-title {
			font-family: "Poppins", sans-serif;
			color: #c084fc;
			font-size: clamp(40px, 4.2vw, 62px);
			font-weight: 800;
			line-height: 1.08;
		}

		.awards-subtitle {
			color: rgba(192, 132, 252, 0.78);
			font-size: clamp(15px, 1.2vw, 22px);
			font-weight: 500;
			margin-top: 10px;
		}

		.awards-grid {
			display: grid;
			grid-template-columns: repeat(2, minmax(0, 1fr));
			gap: 24px;
			justify-content: center;
		}

		.award-card {
			display: grid;
			grid-template-columns: 56px 1fr;
			align-items: start;
			gap: 14px;
			min-height: 154px;
			background: rgba(36, 12, 56, 0.84);
			border: 1px solid rgba(192, 132, 252, 0.24);
			border-radius: 16px;
			padding: 18px 22px;
			box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.03);
		}

		.award-title-row {
			display: block;
			margin-bottom: 0;
		}

		.award-mini-icon {
			width: 56px;
			height: 56px;
			border-radius: 12px;
			display: inline-grid;
			place-items: center;
			background: linear-gradient(145deg, #e195ff 0%, #ca72f3 100%);
			box-shadow: 0 8px 20px rgba(181, 98, 235, 0.34);
		}

		.award-mini-icon svg {
			width: 24px;
			height: 24px;
			stroke: #f7e9ff;
			stroke-width: 2;
			fill: none;
		}

		.award-name {
			color: #e7c2ff;
			font-size: clamp(20px, 1.55vw, 30px);
			font-weight: 700;
			line-height: 1.14;
			margin-bottom: 4px;
		}

		.award-role {
			color: #be72f1;
			font-size: clamp(17px, 1.28vw, 24px);
			font-weight: 600;
			margin-bottom: 8px;
		}

		.award-desc {
			display: block;
			color: rgba(235, 215, 247, 0.86);
			font-size: clamp(14px, 1.02vw, 17px);
			line-height: 1.42;
		}

		.empower-section {
			min-height: 100vh;
			padding: calc(var(--nav-height) + 10px) 26px 34px;
			display: grid;
			align-items: center;
			background:
				radial-gradient(circle at 14% 18%, rgba(107, 26, 107, 0.24), transparent 38%),
				radial-gradient(circle at 88% 72%, rgba(122, 31, 122, 0.22), transparent 36%),
				linear-gradient(180deg, #1a0a2e 0%, #160826 48%, #0f0520 100%);
			border-top: 1px solid rgba(188, 129, 221, 0.2);
		}

		.empower-wrap {
			width: min(1180px, 94vw);
			margin: 0 auto;
		}

		.empower-title {
			text-align: center;
			color: #c084fc;
			font-size: clamp(40px, 4.4vw, 64px);
			font-weight: 800;
			line-height: 1.08;
			margin-bottom: 12px;
		}

		.empower-intro {
			max-width: 920px;
			margin: 0 auto 24px;
			text-align: center;
			color: rgba(244, 227, 255, 0.92);
			font-size: clamp(14px, 1.1vw, 19px);
			font-weight: 500;
			line-height: 1.45;
		}

		.empower-grid {
			display: grid;
			grid-template-columns: repeat(2, minmax(0, 1fr));
			gap: 22px;
		}

		.empower-card {
			background: rgba(36, 12, 56, 0.84);
			border: 1px solid rgba(192, 132, 252, 0.24);
			border-radius: 28px;
			box-shadow: 0 16px 34px rgba(16, 4, 28, 0.26);
			padding: 26px 24px 28px;
			text-align: center;
			min-height: 420px;
		}

		.empower-avatar {
			width: 146px;
			height: 146px;
			margin: 0 auto 18px;
			border-radius: 50%;
			overflow: hidden;
			border: 5px solid rgba(182, 106, 226, 0.5);
			box-shadow: 0 8px 18px rgba(181, 98, 235, 0.28);
			background: radial-gradient(circle at 36% 30%, rgba(182, 131, 218, 0.55), rgba(66, 26, 92, 0.92));
		}

		.empower-meta {
			display: block;
			text-align: center;
		}

		.empower-avatar img {
			width: 100%;
			height: 100%;
			object-fit: cover;
		}

		.empower-name {
			color: #be72f1;
			font-size: clamp(28px, 2.2vw, 44px);
			font-weight: 700;
			line-height: 1.12;
			margin-bottom: 8px;
		}

		.empower-role {
			color: #cc9be8;
			font-size: clamp(17px, 1.2vw, 28px);
			font-weight: 700;
			margin-bottom: 16px;
		}

		.empower-text {
			color: rgba(235, 215, 247, 0.86);
			font-size: clamp(14px, 0.98vw, 17px);
			font-weight: 500;
			line-height: 1.45;
			max-width: 560px;
			margin: 0 auto;
		}

		.story-preview-section {
			min-height: 88vh;
			padding: calc(var(--nav-height) + 20px) 26px 56px;
			display: grid;
			align-items: center;
			background:
				radial-gradient(circle at 18% 24%, rgba(107, 26, 107, 0.24), transparent 40%),
				radial-gradient(circle at 82% 78%, rgba(122, 31, 122, 0.2), transparent 42%),
				linear-gradient(160deg, #1a0a2e 0%, #160826 52%, #0f0520 100%);
			border-top: 1px solid rgba(204, 147, 238, 0.22);
		}

		.story-preview-wrap {
			width: min(1120px, 94vw);
			margin: 0 auto;
		}

		.story-preview-title {
			text-align: center;
			color: #efd7ff;
			font-size: clamp(34px, 4vw, 60px);
			font-weight: 700;
			letter-spacing: 0.06em;
			margin-bottom: 22px;
		}

		.story-preview-card {
			display: grid;
			grid-template-columns: minmax(240px, 340px) 1fr;
			gap: 34px;
			align-items: center;
			border-radius: 26px;
			background: rgba(36, 12, 56, 0.84);
			border: 1px solid rgba(232, 201, 255, 0.18);
			box-shadow: 0 18px 40px rgba(14, 2, 25, 0.35);
			padding: 26px;
		}

		.story-preview-photo {
			border-radius: 34px;
			overflow: hidden;
			border: 1px solid rgba(237, 209, 255, 0.22);
			box-shadow: 0 12px 26px rgba(9, 2, 17, 0.3);
			aspect-ratio: 3 / 4;
		}

		.story-preview-photo img {
			width: 100%;
			height: 100%;
			object-fit: cover;
			display: block;
		}

		.story-preview-name {
			margin-top: 12px;
			color: #f3dcff;
			font-size: clamp(10px, 1.5vw, 17px);
			font-weight: 500;
			text-align: center;
		}

		.story-preview-text {
			color: #f0dbff;
			font-size: clamp(23px, 2.15vw, 36px);
			line-height: 1.25;
			font-weight: 500;
			text-align: center;
		}

		.story-preview-list {
			list-style: none;
			display: grid;
			gap: 14px;
			margin: 0 0 26px;
		}

		.story-preview-list li {
			color: rgba(242, 223, 255, 0.96);
			font-size: clamp(20px, 1.7vw, 34px);
			line-height: 1.3;
		}

		.story-preview-cta {
			display: inline-flex;
			align-items: center;
			justify-content: center;
			padding: 12px 24px;
			border-radius: 999px;
			border: 1px solid rgba(243, 213, 255, 0.46);
			background: rgba(255, 255, 255, 0.14);
			color: #ffeaff;
			font-size: 16px;
			font-weight: 600;
			text-decoration: none;
			transition: transform .2s ease, background .2s ease, border-color .2s ease;
		}

		.story-preview-cta:hover {
			transform: translateY(-1px);
			background: rgba(255, 255, 255, 0.2);
			border-color: rgba(250, 230, 255, 0.7);
		}

		.contact-section {
			min-height: 100vh;
			padding: calc(var(--nav-height) + 26px) 26px 48px;
			display: grid;
			align-items: center;
			background:
				radial-gradient(circle at 20% 12%, rgba(107, 26, 107, 0.24), transparent 34%),
				radial-gradient(circle at 80% 86%, rgba(122, 31, 122, 0.2), transparent 36%),
				linear-gradient(180deg, #1a0a2e 0%, #160826 52%, #0f0520 100%);
			border-top: 1px solid rgba(204, 147, 238, 0.22);
		}

		.contact-wrap {
			width: min(1120px, 94vw);
			margin: 0 auto;
		}

		.contact-title {
			text-align: center;
			font-size: clamp(40px, 4vw, 64px);
			font-weight: 800;
			color: #dca8ff;
			margin-bottom: 22px;
		}

		.contact-card {
			border-radius: 26px;
			padding: 28px 36px 34px;
			background: rgba(36, 12, 56, 0.86);
			border: 1px solid rgba(232, 201, 255, 0.18);
			box-shadow: 0 20px 44px rgba(8, 2, 16, 0.42);
		}

		.contact-icon {
			display: grid;
			place-items: center;
			color: #bc7cf3;
			margin-bottom: 12px;
		}

		.contact-intro {
			text-align: center;
			font-size: clamp(15px, 1.2vw, 24px);
			color: rgba(233, 213, 247, 0.84);
			font-weight: 500;
			margin-bottom: 18px;
		}

		.contact-form {
			display: grid;
			gap: 12px;
		}

		.form-group {
			display: grid;
			gap: 6px;
		}

		.form-group label {
			font-size: 13px;
			font-weight: 700;
			color: rgba(244, 226, 255, 0.94);
		}

		.form-group input,
		.form-group textarea {
			width: 100%;
			border: 1px solid rgba(197, 150, 230, 0.18);
			border-radius: 14px;
			padding: 12px 14px;
			background: rgba(255, 255, 255, 0.12);
			color: #f9ecff;
			font-size: 14px;
			font-family: "Poppins", sans-serif;
			outline: none;
			transition: border-color .2s ease, box-shadow .2s ease;
		}

		.form-group input::placeholder,
		.form-group textarea::placeholder {
			color: rgba(235, 214, 248, 0.58);
		}

		.form-group input:focus,
		.form-group textarea:focus {
			border-color: rgba(212, 165, 246, 0.55);
			box-shadow: 0 0 0 3px rgba(183, 119, 228, 0.16);
		}

		.form-group textarea {
			min-height: 120px;
			resize: vertical;
		}

		.contact-submit {
			margin-top: 6px;
			display: inline-flex;
			align-items: center;
			justify-content: center;
			gap: 8px;
			width: 100%;
			border: 0;
			border-radius: 999px;
			padding: 12px 16px;
			font-size: 15px;
			font-weight: 700;
			color: #fff;
			background: linear-gradient(90deg, #9c4fdd 0%, #db70b8 100%);
			cursor: pointer;
		}

		.site-footer {
			padding: 34px 26px 26px;
			background:
				radial-gradient(circle at 22% 16%, rgba(107, 26, 107, 0.2), transparent 36%),
				radial-gradient(circle at 80% 90%, rgba(122, 31, 122, 0.18), transparent 38%),
				linear-gradient(180deg, #17072a 0%, #120520 100%);
			border-top: 1px solid rgba(188, 129, 221, 0.2);
		}

		.footer-wrap {
			width: min(1120px, 94vw);
			margin: 0 auto;
		}

		.footer-main {
			display: grid;
			grid-template-columns: 1fr;
			gap: 24px;
			padding: 22px 24px;
			border-radius: 20px;
			background: rgba(34, 11, 54, 0.85);
			border: 1px solid rgba(213, 168, 241, 0.2);
			box-shadow: 0 16px 34px rgba(8, 2, 16, 0.38);
		}

		.footer-brand {
			display: grid;
			gap: 10px;
			text-align: center;
		}

		.footer-brand h4 {
			font-size: clamp(22px, 2vw, 30px);
			font-weight: 800;
			color: #e6ccff;
		}

		.footer-brand p {
			font-size: 14px;
			line-height: 1.5;
			color: rgba(232, 213, 246, 0.84);
		}

		.footer-bottom {
			margin-top: 14px;
			padding-top: 14px;
			border-top: 1px solid rgba(194, 139, 232, 0.2);
			text-align: center;
			font-size: 13px;
			color: rgba(216, 190, 236, 0.7);
		}

		.page-nav-arrows {
			position: fixed;
			right: 16px;
			bottom: 16px;
			display: grid;
			gap: 8px;
			z-index: 30;
		}

		.arrow-btn {
			width: 42px;
			height: 42px;
			border-radius: 50%;
			display: inline-flex;
			align-items: center;
			justify-content: center;
			text-decoration: none;
			font-size: 20px;
			color: #e3baf9;
			background: rgba(82, 31, 118, 0.7);
			border: 1px solid rgba(195, 139, 235, 0.34);
			box-shadow: 0 8px 18px rgba(10, 2, 18, 0.3);
			cursor: pointer;
			transition: transform .2s ease, background .2s ease;
		}

		.arrow-btn:hover {
			transform: translateY(-1px);
			background: rgba(103, 46, 142, 0.82);
		}

		.hero-card {
			width: var(--shell-width);
			border-radius: 28px;
			border: 1px solid rgba(192, 132, 252, 0.28);
			background: rgba(20, 8, 38, 0.9);
			box-shadow: 0 34px 70px var(--shadow), 0 0 34px rgba(131, 61, 166, 0.32);
			text-align: center;
			padding: 52px 30px 44px;
			position: relative;
			z-index: 1;
		}

		.spark {
			background: linear-gradient(135deg, #7c3aed 0%, #9333ea 100%);
			-webkit-background-clip: text;
			background-clip: text;
			color: transparent;
			font-size: 44px;
			line-height: 1;
			margin-bottom: 14px;
		}

		h1 {
			color: var(--title);
			font-size: clamp(44px, 6vw, 72px);
			font-weight: 800;
			line-height: 1;
			margin-bottom: 10px;
		}

		h2 {
			color: var(--text-main);
			font-size: clamp(26px, 3.2vw, 48px);
			font-weight: 500;
			line-height: 1.12;
			margin-bottom: 8px;
		}

		.hero-text {
			color: var(--text-sub);
			font-size: clamp(16px, 1.6vw, 28px);
			font-weight: 500;
		}

		.down {
			margin-top: 30px;
			width: 54px;
			height: 54px;
			border-radius: 50%;
			border: 1px solid rgba(139, 92, 246, 0.40);
			background: rgba(139, 92, 246, 0.25);
			display: inline-flex;
			align-items: center;
			justify-content: center;
			color: #e4b7fa;
			text-decoration: none;
			font-size: 24px;
			line-height: 1;
		}

		@media (max-width: 1060px) {
			.brand {
				font-size: 20px;
			}

			.menu {
				gap: 14px;
			}

			.menu a {
				font-size: 12px;
			}
		}

		@media (max-width: 740px) {
			nav {
				height: auto;
				padding: 10px 14px;
				flex-direction: column;
				gap: 8px;
			}

			.menu {
				flex-wrap: wrap;
				justify-content: center;
			}

			.strip-box {
				width: min(98vw, 98vw);
			}

			.strip-item {
				width: 76px;
				height: 128px;
			}

			.hero-carousel {
				top: 56%;
			}

			.carousel-item {
				width: 102px;
				height: 164px;
			}

			.hero {
				padding-top: 108px;
			}

			.hero-card {
				padding: 40px 18px 36px;
			}

			.about-section {
				padding: 108px 16px 64px;
			}

			.about-card {
				padding: 28px 20px 30px;
				border-radius: 24px;
			}

			.team-section {
				padding: calc(var(--nav-height) + 28px) 14px 32px;
			}

			.ideas-section {
				padding: calc(var(--nav-height) + 28px) 14px 34px;
			}

			.ideas-head {
				margin-bottom: 20px;
			}

			.ideas-grid {
				grid-template-columns: 1fr;
				gap: 14px;
			}

			.idea-card {
				min-height: 340px;
				border-radius: 18px;
			}

			.idea-content {
				padding: 18px 18px 18px;
			}

			.idea-name {
				font-size: 28px;
			}

			.idea-role {
				font-size: 13px;
			}

			.idea-desc {
				font-size: 12px;
				max-width: 100%;
			}

			.awards-section {
				padding: calc(var(--nav-height) + 30px) 14px 34px;
			}

			.awards-head {
				margin-bottom: 20px;
			}

			.awards-title-row {
				display: block;
			}

			.awards-grid {
				grid-template-columns: 1fr;
				gap: 14px;
			}

			.empower-section {
				padding: calc(var(--nav-height) + 8px) 14px 24px;
				align-items: center;
			}

			.empower-title {
				margin-bottom: 22px;
			}

			.empower-intro {
				font-size: 13px;
				line-height: 1.5;
				margin: 0 auto 18px;
				max-width: 100%;
			}

			.empower-grid {
				grid-template-columns: 1fr;
				gap: 16px;
			}

			.empower-card {
				padding: 16px 14px;
				border-radius: 18px;
				text-align: center;
				min-height: 0;
			}

			.empower-avatar {
				width: 104px;
				height: 104px;
				margin: 0 auto;
				margin-bottom: 14px;
			}

			.empower-meta {
				text-align: center;
			}

			.empower-name {
				font-size: 30px;
				margin-bottom: 6px;
			}

			.empower-role {
				font-size: 14px;
				margin-bottom: 6px;
			}

			.empower-text {
				font-size: 13px;
				max-width: 100%;
				margin: 0 auto;
			}

			.story-preview-section {
				padding: calc(var(--nav-height) + 18px) 14px 34px;
			}

			.story-preview-title {
				margin-bottom: 14px;
			}

			.story-preview-card {
				grid-template-columns: 1fr;
				gap: 18px;
				padding: 16px;
				border-radius: 18px;
			}

			.story-preview-photo {
				max-width: 280px;
				margin: 0 auto;
				border-radius: 20px;
			}

			.story-preview-name {
				font-size: 8px;
			}

			.story-preview-list {
				gap: 8px;
				margin-bottom: 16px;
			}

			.story-preview-list li {
				font-size: 16px;
				text-align: center;
			}

			.story-preview-cta {
				width: 100%;
				font-size: 15px;
			}

			.contact-section {
				padding: calc(var(--nav-height) + 14px) 14px 26px;
			}

			.contact-title {
				margin-bottom: 14px;
			}

			.contact-card {
				padding: 18px 14px 20px;
				border-radius: 18px;
			}

			.contact-intro {
				font-size: 14px;
				margin-bottom: 14px;
			}

			.site-footer {
				padding: 12px 14px 20px;
			}

			.footer-main {
				grid-template-columns: 1fr;
				gap: 16px;
				padding: 16px 14px;
				border-radius: 16px;
			}

			.footer-brand h4 {
				font-size: 22px;
			}

			.page-nav-arrows {
				right: 12px;
				bottom: 12px;
			}

			.arrow-btn {
				width: 40px;
				height: 40px;
				font-size: 19px;
			}

			.award-card {
				grid-template-columns: 48px 1fr;
				gap: 12px;
				padding: 14px 14px;
				border-radius: 16px;
				min-height: 128px;
			}

			.award-mini-icon {
				width: 48px;
				height: 48px;
			}

			.award-mini-icon svg {
				width: 19px;
				height: 19px;
			}

			.award-name {
				font-size: 20px;
			}

			.award-role {
				font-size: 15px;
				margin-bottom: 6px;
			}

			.award-desc {
				font-size: 13px;
			}

			.info-grid {
				grid-template-columns: 1fr;
				gap: 12px;
			}

			.info-card {
				grid-template-columns: 86px 1fr;
				gap: 12px;
				padding: 14px;
				border-radius: 14px;
				min-height: 292px;
			}

			.info-badge {
				font-size: 13px;
			}

			.info-avatar {
				width: 86px;
				height: 86px;
			}

			.info-name {
				font-size: 22px;
			}

			.info-role {
				font-size: 14px;
			}

			.info-teaser,
			.info-more {
				font-size: 12px;
			}

			.info-list li {
				font-size: 14px;
			}

			.member-modal {
				padding: 12px;
			}

			.modal-panel {
				padding: 16px 12px 16px;
			}

			.modal-top .info-badge {
				font-size: 11px;
			}

			.modal-top .info-avatar {
				width: 96px;
				height: 96px;
			}

			.modal-top .info-name {
				font-size: 28px;
			}

			.modal-top .info-role {
				font-size: 14px;
			}

			.modal-intro {
				font-size: 13px;
			}

			.modal-subtitle {
				font-size: 14px;
			}

			.modal-points li {
				font-size: 13px;
			}

			.spark {
				font-size: 38px;
			}
		}

		
.shiny-text {
    position: relative;
    display: inline-block;
    font-weight: 800;

    background: linear-gradient(
        120deg,
        #a855f7 0%,
        #ffffff 20%,
        #c084fc 40%,
        #a855f7 60%
    );

    background-size: 200% auto;
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;

    animation: shine 3s linear infinite;

    text-shadow: 
        0 0 10px rgba(168, 85, 247, 0.6),
        0 0 20px rgba(168, 85, 247, 0.4);
}

@keyframes shine {
    0% {
        background-position: -200% center;
    }
    100% {
        background-position: 200% center;
    }
}


.gooey-nav {
    display: flex;
    gap: 20px;
}

.gooey-nav li {
    list-style: none;
}

.gooey-nav a {
    position: relative;
    padding: 8px 16px;
    color: rgba(255,255,255,0.7);
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
    border-radius: 999px;
    transition: 0.3s;
}


.gooey-nav a::before {
    content: "";
    position: absolute;
    inset: 0;
    border-radius: 999px;
    background: radial-gradient(circle at 30% 30%, #c084fc, #9333ea);
    filter: blur(12px);
    opacity: 0;
    transform: scale(0.6);
    transition: 0.4s ease;
    z-index: -1;
}


.gooey-nav a:hover::before {
    opacity: 1;
    transform: scale(1);
}

.gooey-nav a:hover {
    color: #fff;
}


.down {
    position: relative;
    display: inline-flex;
    align-items: center;
    justify-content: center;

    width: 48px;
    height: 48px;
    border-radius: 50%;

    background: rgba(168, 85, 247, 0.1);
    border: 1px solid rgba(192, 132, 252, 0.4);
    color: #fff;

    transition: all 0.3s ease;
    overflow: hidden;
}


.down::before {
    content: "";
    position: absolute;
    inset: -6px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(168,85,247,0.7), transparent 70%);
    opacity: 0;
    transition: 0.4s;
    z-index: -1;
}


.down:hover::before {
    opacity: 1;
    transform: scale(1.2);
}

.down:hover {
    box-shadow:
        0 0 20px rgba(168,85,247,0.7),
        0 0 50px rgba(168,85,247,0.5);
    transform: translateY(-3px);
}


.down:active {
    transform: scale(0.9);
    box-shadow:
        0 0 30px rgba(192,132,252,0.9),
        0 0 60px rgba(168,85,247,0.7);
}

.about-section p {
    text-align: justify;
    max-width: 800px;
    margin: 0 auto;
    text-indent: 50px;
    line-height: 1.7;
    letter-spacing: 0.3px;
}


.section-title {
    text-align: center;
    font-weight: 800;

    background: linear-gradient(
        120deg,
        #a855f7 0%,
        #ffffff 25%,
        #c084fc 50%,
        #a855f7 75%
    );

    background-size: 200% auto;
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;

    animation: shine 3s linear infinite;

    text-shadow:
        0 0 10px rgba(168, 85, 247, 0.6),
        0 0 25px rgba(168, 85, 247, 0.4);
}


.hero-title {
    font-weight: 800;
    text-align: center;

    background: linear-gradient(
        120deg,
        #c084fc 0%,
        #ffffff 25%,
        #a855f7 50%,
        #ffffff 75%,
        #c084fc 100%
    );

    background-size: 200% auto;
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;

    animation: shine 4s linear infinite;

    text-shadow:
        0 0 15px rgba(192, 132, 252, 0.8),
        0 0 35px rgba(168, 85, 247, 0.6);
}

.empower-card {
    position: relative;
    border-radius: 20px;
    transition: 0.3s ease;

    
    box-shadow:
        0 0 20px rgba(168, 85, 247, 0.15);
}


.empower-card:hover {
    box-shadow:
        0 0 25px rgba(168, 85, 247, 0.25),
        0 0 50px rgba(168, 85, 247, 0.15);

    transform: translateY(-4px);
}


.award-card {
    position: relative;
    display: grid;
    grid-template-columns: 56px 1fr;
    gap: 14px;

    border-radius: 18px;
    padding: 18px 22px;

    background: rgba(40, 12, 60, 0.55);
    backdrop-filter: blur(14px);

    border: 1px solid rgba(192, 132, 252, 0.25);

    overflow: hidden;
    cursor: pointer;

    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.award-card::before {
    content: "";
    position: absolute;
    inset: -2px;
    border-radius: inherit;

    background: linear-gradient(
        120deg,
        #c084fc,
        #a855f7,
        #ffffff,
        #a855f7,
        #c084fc
    );

    background-size: 300% 300%;
    animation: borderFlow 6s linear infinite;

    opacity: 0.6;
    filter: blur(8px);
    z-index: -1;
}
.award-card::after {
    content: "";
    position: absolute;
    inset: 0;
    border-radius: inherit;

    background: radial-gradient(
        circle at var(--x, 50%) var(--y, 50%),
        rgba(192,132,252,0.18),
        rgba(192,132,252,0.08) 30%,
        transparent 65%
    );

    opacity: 0;
    transition: opacity 0.25s ease;
    pointer-events: none;
}
@keyframes borderFlow {
    0% { background-position: 0% 50%; }
    100% { background-position: 300% 50%; }
}


.award-card:hover {
    transform: translateY(-6px) scale(1.02);

    box-shadow:
        0 0 20px rgba(168, 85, 247, 0.4),
        0 0 40px rgba(168, 85, 247, 0.2),
        0 15px 30px rgba(0,0,0,0.4);
}


.info-card {
    border-radius: 20px;
    transition: 0.3s ease;

    
    box-shadow:
        0 0 18px rgba(168, 85, 247, 0.12);
}


.info-card:hover {
    box-shadow:
        0 0 25px rgba(168, 85, 247, 0.22),
        0 0 45px rgba(168, 85, 247, 0.12);

    transform: translateY(-4px);
}


.story-preview-cta {
    position: relative;
    display: inline-block;

    padding: 12px 26px;
    border-radius: 30px;

    color: #e9d5ff;
    text-decoration: none;

    background: rgba(168, 85, 247, 0.08);
    border: 1px solid rgba(168, 85, 247, 0.2);

    backdrop-filter: blur(10px);

    transition: all 0.3s ease;

    
    box-shadow:
        0 0 10px rgba(168, 85, 247, 0.25),
        0 0 25px rgba(168, 85, 247, 0.15);
}


.story-preview-cta:hover {
    transform: translateY(-2px);

    box-shadow:
        0 0 18px rgba(168, 85, 247, 0.45),
        0 0 40px rgba(168, 85, 247, 0.25),
        0 0 60px rgba(168, 85, 247, 0.15);
}

.story-preview-cta::after {
    content: "";
    position: absolute;
    inset: -6px;
    border-radius: inherit;

    background: radial-gradient(
        circle,
        rgba(168, 85, 247, 0.25),
        transparent 70%
    );

    filter: blur(12px);
    z-index: -1;
}


.arrow-btn {
    position: relative;

    width: 42px;
    height: 42px;
    border-radius: 50%;

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 20px;
    color: #e9d5ff;

    background: rgba(168, 85, 247, 0.08);
    border: 1px solid rgba(168, 85, 247, 0.25);

    backdrop-filter: blur(10px);

    transition: all 0.3s ease;

   
    box-shadow:
        0 0 12px rgba(168, 85, 247, 0.25),
        0 0 25px rgba(168, 85, 247, 0.15);
}


.arrow-btn:hover {
    transform: translateY(-3px) scale(1.05);

    box-shadow:
        0 0 20px rgba(168, 85, 247, 0.45),
        0 0 45px rgba(168, 85, 247, 0.25),
        0 0 70px rgba(168, 85, 247, 0.15);
}


.arrow-btn::after {
    content: "";
    position: absolute;
    inset: -6px;
    border-radius: 50%;

    background: radial-gradient(
        circle,
        rgba(168, 85, 247, 0.3),
        transparent 70%
    );

    filter: blur(10px);
    z-index: -1;
}

.arrow-btn {
    animation: arrowPulse 2s infinite alternate;
}

@keyframes arrowPulse {
    from {
        box-shadow: 0 0 8px rgba(168, 85, 247, 0.2);
    }
    to {
        box-shadow: 0 0 18px rgba(168, 85, 247, 0.5);
    }
}

.contact-title {
    font-weight: 800;
    text-align: center;

    background: linear-gradient(
        120deg,
        #c084fc 0%,
        #ffffff 25%,
        #a855f7 50%,
        #ffffff 75%,
        #c084fc 100%
    );

    background-size: 200% auto;
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;

    animation: shine 4s linear infinite;

    text-shadow:
        0 0 15px rgba(192, 132, 252, 0.8),
        0 0 35px rgba(168, 85, 247, 0.6);
}

.brand {
    display: inline-flex;
    align-items: center;
    gap: 8px;

    font-weight: 800;
    font-size: 22px;

    
    background: linear-gradient(
        120deg,
        #ffffff 0%,
        #e0aaff 20%,
        #c77dff 40%,
        #ffffff 60%,
        #9d4edd 80%,
        #ffffff 100%
    );

    background-size: 300% auto;
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;

    animation: metallicFlow 6s linear infinite;

    text-shadow:
        0 0 10px rgba(168, 85, 247, 0.6),
        0 0 25px rgba(168, 85, 247, 0.4);
}

.brand {
    position: relative;
    display: inline-flex;
    align-items: center;
    gap: 8px;

    font-weight: 800;
    font-size: 22px;

    background: linear-gradient(
        120deg,
        #ffffff 0%,
        #e0aaff 20%,
        #c77dff 40%,
        #ffffff 60%,
        #9d4edd 80%,
        #ffffff 100%
    );

    background-size: 300% auto;
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;

    animation: metallicFlow 6s linear infinite;

    transition: all 0.3s ease;
}

.brand:hover {
    text-shadow:
        0 0 10px rgba(168, 85, 247, 0.9),
        0 0 25px rgba(168, 85, 247, 0.7),
        0 0 50px rgba(168, 85, 247, 0.5);

    transform: scale(1.05);
}

nav a {
    position: relative;
    text-decoration: none;
    color: #d8b4fe;
    font-weight: 500;

    transition: all 0.3s ease;
}

nav a:hover {
    color: #ffffff;

    text-shadow:
        0 0 8px rgba(168, 85, 247, 0.9),
        0 0 20px rgba(168, 85, 247, 0.7),
        0 0 40px rgba(168, 85, 247, 0.5);

    transform: translateY(-2px);
}

nav a::after {
    content: "";
    position: absolute;
    left: 50%;
    bottom: -6px;
    width: 0%;
    height: 2px;

    background: linear-gradient(90deg, transparent, #c084fc, transparent);
    transform: translateX(-50%);
    transition: 0.3s ease;
    opacity: 0;
}

nav a:hover::after {
    width: 100%;
    opacity: 1;
}

nav a.active {
    color: #fff;

    text-shadow:
        0 0 10px rgba(168, 85, 247, 1),
        0 0 30px rgba(168, 85, 247, 0.7);
}

.team-section .info-name {
    color: #c084fc; 

    text-shadow:
        0 0 4px rgba(147, 51, 234, 0.4),
        0 0 10px rgba(147, 51, 234, 0.25);

    transition: all 0.3s ease;
}

.team-section .info-card:hover .info-name {
    color: #e9d5ff;

    text-shadow:
        0 0 8px rgba(147, 51, 234, 0.6),
        0 0 18px rgba(147, 51, 234, 0.4),
        0 0 30px rgba(147, 51, 234, 0.3);

    transform: scale(1.02);
}


.idea-name {
    color: #9333ea; /* darker purple */

    text-shadow:
        0 0 3px rgba(88, 28, 135, 0.4),
        0 0 8px rgba(88, 28, 135, 0.25);

    transition: all 0.3s ease;
}

.idea-card:hover .idea-name {
    color: #e9d5ff;

    text-shadow:
        0 0 8px rgba(147, 51, 234, 0.6),
        0 0 18px rgba(147, 51, 234, 0.4),
        0 0 30px rgba(147, 51, 234, 0.3);

    transform: scale(1.02);
}


.award-name {
    color: #e9d5ff; 

    text-shadow:
        0 0 6px rgba(192, 132, 252, 0.6),
        0 0 15px rgba(192, 132, 252, 0.4),
        0 0 25px rgba(192, 132, 252, 0.3);

    transition: all 0.3s ease;
}

.award-card:hover .award-name {
    color: #e9d5ff;

    text-shadow:
        0 0 8px rgba(147, 51, 234, 0.6),
        0 0 18px rgba(147, 51, 234, 0.4),
        0 0 30px rgba(147, 51, 234, 0.3);

    transform: scale(1.02);
}



.empower-name {
    color: #9333ea; 

    text-shadow:
        0 0 3px rgba(88, 28, 135, 0.4),
        0 0 8px rgba(88, 28, 135, 0.25);

    transition: all 0.3s ease;
}


.empower-card:hover .empower-name {
    color: #e9d5ff;

    text-shadow:
        0 0 8px rgba(147, 51, 234, 0.6),
        0 0 18px rgba(147, 51, 234, 0.4),
        0 0 30px rgba(147, 51, 234, 0.3);

    transform: scale(1.02);
}


.story-preview-list li {
    color: #e9d5ff; 

    text-shadow:
        0 0 8px rgba(192, 132, 252, 0.8),
        0 0 18px rgba(192, 132, 252, 0.6),
        0 0 30px rgba(192, 132, 252, 0.4);

    transition: all 0.3s ease;
}


.story-preview-name {
    color: #e9dafa;

    text-shadow:
        0 0 6px rgba(192, 132, 252, 0.8),
        0 0 14px rgba(192, 132, 252, 0.6),
        0 0 25px rgba(192, 132, 252, 0.4);

    transition: all 0.3s ease;
}

.story-preview-name:hover {
    color: #ffffff;

    text-shadow:
        0 0 10px rgba(192, 132, 252, 1),
        0 0 25px rgba(192, 132, 252, 0.8),
        0 0 40px rgba(192, 132, 252, 0.6);
}

.story-preview-card {
    border: 1px solid rgba(192, 132, 252, 0.3);

    box-shadow:
        0 0 10px rgba(192, 132, 252, 0.25),
        0 0 25px rgba(192, 132, 252, 0.15);

    transition: all 0.3s ease;
}

.story-preview-card:hover {
    box-shadow:
        0 0 15px rgba(192, 132, 252, 0.5),
        0 0 35px rgba(192, 132, 252, 0.3),
        0 0 60px rgba(192, 132, 252, 0.2);
}

.story-preview-photo {
    border-radius: 16px;
    overflow: hidden;

    border: 2px solid rgba(192, 132, 252, 0.5);

    box-shadow:
        0 0 10px rgba(192, 132, 252, 0.4),
        0 0 20px rgba(192, 132, 252, 0.25);

    transition: all 0.3s ease;
}
.story-preview-photo:hover {
    box-shadow:
        0 0 15px rgba(192, 132, 252, 0.7),
        0 0 30px rgba(192, 132, 252, 0.4),
        0 0 50px rgba(192, 132, 252, 0.3);
}

.hero-card {
    position: relative;
    border-radius: 20px;

    border: 1px solid rgba(192, 132, 252, 0.25);
    background: rgba(30, 10, 60, 0.6);
    backdrop-filter: blur(10px);

    box-shadow:
        0 0 20px rgba(192, 132, 252, 0.25),
        0 0 60px rgba(192, 132, 252, 0.15);

    transition: all 0.4s ease;
}.hero-card::before {
    content: "";
    position: absolute;
    inset: -25px;
    border-radius: 30px;

    background: radial-gradient(circle, rgba(192,132,252,0.25), transparent 70%);
    filter: blur(30px);
    z-index: -1;
}

.hero-card::after {
    content: "";
    position: absolute;
    inset: 0;
    border-radius: 20px;

    box-shadow:
        inset 0 0 30px rgba(192, 132, 252, 0.15);

    pointer-events: none;
}

.about-card {
    position: relative;
    border-radius: 20px;

    border: 1px solid rgba(192, 132, 252, 0.25);
    background: rgba(60, 20, 90, 0.4);
    backdrop-filter: blur(10px);

    box-shadow:
        0 0 15px rgba(192, 132, 252, 0.25),
        0 0 40px rgba(192, 132, 252, 0.15);

    transition: all 0.4s ease;
}

.about-card::before {
    content: "";
    position: absolute;
    inset: -20px;
    border-radius: 30px;

    background: radial-gradient(circle, rgba(192,132,252,0.2), transparent 70%);
    filter: blur(25px);
    z-index: -1;
}
.about-card:hover {
    box-shadow:
        0 0 25px rgba(192, 132, 252, 0.5),
        0 0 70px rgba(192, 132, 252, 0.3),
        0 0 100px rgba(192, 132, 252, 0.2);
}

.about-title {
    color: #e9d5ff;

    text-shadow:
        0 0 8px rgba(192, 132, 252, 0.8),
        0 0 18px rgba(192, 132, 252, 0.6),
        0 0 30px rgba(192, 132, 252, 0.4);
}

.about-card {
    max-width: 900px;   
    width: 100%;
    margin: 0 auto;
}

.about-card {
    padding: 40px 50px; /* increase padding */
}

.about-title {
    font-size: 45px;
    margin-bottom: 20px;
}

.highlight {
    color: #e9d5ff;

    text-shadow:
        0 0 6px rgba(192, 132, 252, 0.8),
        0 0 14px rgba(192, 132, 252, 0.5);

    font-weight: 600;
}

.highlight-strong {
    color: #ffffff;

    text-shadow:
        0 0 10px rgba(192, 132, 252, 1),
        0 0 25px rgba(192, 132, 252, 0.8),
        0 0 40px rgba(192, 132, 252, 0.6);

    font-weight: 700;
}
/* SCROLL ANIMATION BASE */
.animate-on-scroll {
    opacity: 0;
    transform: translateY(80px) scale(0.92);
    filter: blur(10px);

    transition:
        opacity 1.2s ease,
        transform 1.2s cubic-bezier(0.22, 1, 0.36, 1),
        filter 1.2s ease;
}

.animate-on-scroll.show {
    opacity: 1;
    transform: translateY(0) scale(1);
    filter: blur(0);
}

/* VARIATIONS */
.fade-left {
    transform: translateX(-40px);
}

.fade-right {
    transform: translateX(40px);
}

.zoom-in {
    transform: scale(0.8);
}

/* STAGGER EFFECT */
.animate-delay-1 { transition-delay: 0.1s; }
.animate-delay-2 { transition-delay: 0.2s; }
.animate-delay-3 { transition-delay: 0.3s; }
.animate-delay-4 { transition-delay: 0.4s; }

.hero,
.about-section,
.team-section,
.awards-section,
.empower-section {
    background-attachment: fixed;
}

body::before {
    content: "";
    position: fixed;
    top: -20%;
    left: -20%;
    width: 140%;
    height: 140%;

    background: radial-gradient(
        circle,
        rgba(192,132,252,0.15),
        transparent 60%
    );

    animation: ambientMove 20s linear infinite;
    z-index: -1;
}

@keyframes ambientMove {
    0% { transform: translate(0,0); }
    50% { transform: translate(50px, 30px); }
    100% { transform: translate(0,0); }
}
.hero-card {
    animation: heroReveal 1.5s ease forwards;
}

@keyframes heroReveal {
    0% {
        opacity: 0;
        transform: translateY(60px) scale(0.9);
        filter: blur(10px);
    }
    100% {
        opacity: 1;
        transform: translateY(0) scale(1);
        filter: blur(0);
    }
}
.particle {
    position: absolute;
    bottom: -10px;
    width: 4px;
    height: 4px;
    background: rgba(192,132,252,0.6);
    border-radius: 50%;
    animation: rise 8s linear infinite;
}
.particle {
    position: absolute;
    
    animation: rise 8s linear infinite;
}

@keyframes rise {
    0% { transform: translateY(0); opacity: 0; }
    30% { opacity: 1; }
    100% { transform: translateY(-100vh); opacity: 0; }
}
.hero {
    position: relative;
    overflow: hidden;
}
/* ===== HERO STORY ANIMATION ===== */
.her-story-animate {
    opacity: 0;
    transform: translateY(80px) scale(0.95);
    filter: blur(6px);

    transition: all 0.9s cubic-bezier(0.22, 1, 0.36, 1);
}

.her-story-animate.show {
    opacity: 1;
    transform: translateY(0) scale(1);
    filter: blur(0);
}
/* floating glow */
.her-story-card {
    transition: all 0.4s ease;
}

.her-story-card:hover {
    transform: translateY(-6px) scale(1.01);

    box-shadow:
        0 0 25px rgba(192, 132, 252, 0.5),
        0 0 70px rgba(192, 132, 252, 0.3),
        0 0 120px rgba(192, 132, 252, 0.2);
}
.story-list span {
    display: block;
    opacity: 0;
    transform: translateY(20px);

    transition: all 0.6s ease;
}

.story-list.show span {
    opacity: 1;
    transform: translateY(0);
}

/* stagger delays */
.story-list span:nth-child(1) { transition-delay: 0.1s; }
.story-list span:nth-child(2) { transition-delay: 0.2s; }
.story-list span:nth-child(3) { transition-delay: 0.3s; }
.story-list span:nth-child(4) { transition-delay: 0.4s; }
.story-list span:nth-child(5) { transition-delay: 0.5s; }
.story-list span:nth-child(6) { transition-delay: 0.6s; }
	</style>
</head>
<body>
	<nav>
		<a class="brand" href="#home">
			<span class="icon">✦</span>
			<span>Explicitly Her</span>
		</a>
		<ul class="menu gooey-nav">
    <li><a href="#home">Home</a></li>
    <li><a href="#about">About</a></li>
    <li><a href="#team">Team</a></li>
    <li><a href="#leaders">Leaders</a></li>
    <li><a href="#excellence">Excellence</a></li>
    <li><a href="#contact">Contact</a></li>
</ul>
	</nav>

	<main class="hero" id="home">
		<div class="particle" style="left:20%"></div>
    	<div class="particle" style="left:50%"></div>
    	<div class="particle" style="left:80%"></div>
		<div class="hero-carousel" aria-hidden="true">
			<div class="carousel-track">
				<?php for ($loop = 0; $loop < 3; $loop++): ?>
					<?php foreach ($homeStripImagePaths as $imagePath): ?>
						<?php $imageName = basename($imagePath); ?>
						<div class="carousel-item"><img src="images/<?= htmlspecialchars($imageName, ENT_QUOTES, 'UTF-8'); ?>" alt=""></div>
					<?php endforeach; ?>
				<?php endfor; ?>
			</div>
		</div>
		<section class="hero-card animate-on-scroll">
			<div class="spark">✧</div>
			<h1 class="shiny-text">Explicitly Her</h1>
			<h2>Where Women in Tech Shine</h2>
			<p class="hero-text">Celebrating excellence, innovation, and leadership</p>
			<a class="down" href="#about" aria-label="Scroll down">⌄</a>
		</section>
	</main>

	<section class="about-section" id="about">
		<article class="about-card animate-on-scroll">
			<h2 class="about-title">About Her</h2>
			<p class="about-text">
    <span class="highlight">Women in technology</span> are not just participants—they are 
    <span class="highlight">visionaries, innovators, and leaders</span> shaping the future.

    They bring <span class="highlight">unique perspectives</span>, drive meaningful change, and build communities that 
    <span class="highlight">empower the next generation</span>.

    At <span class="highlight-strong">EXPLICIT</span>, we celebrate the excellence, dedication, and brilliance of women who are 
    <span class="highlight">redefining what's possible</span> in tech.
</p>
		</article>
	</section>


	

	<section class="team-section" id="team">
		<h2 class="section-title">Women Behind the System</h2>
		<div class="info-grid">
			<?php $i = 1; foreach ($memberCards as $card): ?>
				<article class="info-card animate-on-scroll"
    data-badge="<?= htmlspecialchars($card['badge'], ENT_QUOTES, 'UTF-8') ?>"
    data-name="<?= htmlspecialchars($card['name'], ENT_QUOTES, 'UTF-8') ?>"
    data-role="<?= htmlspecialchars($card['role'], ENT_QUOTES, 'UTF-8') ?>"
    data-detail="<?= htmlspecialchars($card['detail'], ENT_QUOTES, 'UTF-8') ?>"
    data-image="images/<?= htmlspecialchars($card['image'], ENT_QUOTES, 'UTF-8') ?>"
    data-points='<?= htmlspecialchars(json_encode($card['points']), ENT_QUOTES, 'UTF-8') ?>'>
					<span class="info-badge"><?= htmlspecialchars($card['badge'], ENT_QUOTES, 'UTF-8'); ?></span>
					<div class="info-avatar">
						<img src="images/<?= htmlspecialchars((string) $card['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?= htmlspecialchars($card['name'], ENT_QUOTES, 'UTF-8'); ?>">
					</div>
					<div class="info-copy">
						<h4 class="info-name"><?= htmlspecialchars($card['name'], ENT_QUOTES, 'UTF-8'); ?></h4>
						<p class="info-role"><?= htmlspecialchars($card['role'], ENT_QUOTES, 'UTF-8'); ?></p>
						<p class="info-teaser"><?= htmlspecialchars($card['teaser'], ENT_QUOTES, 'UTF-8'); ?></p>
						<p class="info-more">Click to learn more</p>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</section>

	<section class="ideas-section" id="excellence">
		<div class="ideas-decor" aria-hidden="true">
			<span class="s1">✨</span>
			<span class="s2">⭐</span>
			<span class="s3">⭐</span>
			<span class="s4">✨</span>
		</div>
		<div class="ideas-wrap">
			<header class="ideas-head">
				<h2 class="hero-title">Where Ideas Come to Life</h2>
				<p class="ideas-subtitle">Creativity blooms in the garden of innovation</p>
			</header>
			<div class="ideas-grid">
				<article class="idea-card animate-on-scroll fade-left animate-delay-1">
					<img class="idea-photo" src="images/Capuso.webp" alt="Maria Nicole Capuso">
					<span class="idea-corner" aria-hidden="true">☁️</span>
					<div class="idea-content">
						<p class="idea-tag">CREATIVITY</p>
						<h4 class="idea-name">MARIA NICOLE CAPUSO</h4>
						<p class="idea-role">Director of Creatives</p>
						<p class="idea-desc">Maria transforms ideas into visual stories that inspire and represent EXPLICIT's identity.</p>
					</div>
				</article>
				<article class="idea-card animate-on-scroll fade-right animate-delay-2">
					<img class="idea-photo" src="images/Quizana.webp" alt="Rhaya Mariella Quizana">
					<span class="idea-corner" aria-hidden="true">💻</span>
					<div class="idea-content">
						<p class="idea-tag">INNOVATION</p>
						<h4 class="idea-name">RHAYA MARIELLA QUIZANA</h4>
						<p class="idea-role">Chief Information Officer</p>
						<p class="idea-desc">Rhaya leads digital innovation, ensuring efficient systems and a future-ready organization.</p>
					</div>
				</article>
			</div>
		</div>
	</section>

	<section class="ideas-section" id="leaders">
		<div class="ideas-decor" aria-hidden="true">
			<span class="s1">✨</span>
			<span class="s2">⭐</span>
			<span class="s3">⭐</span>
			<span class="s4">✨</span>
		</div>
		<div class="ideas-wrap">
			<header class="ideas-head">
				<h2 class="section-title">The Next Generation of Leaders</h2>
				<p class="ideas-subtitle">New voices rising, new dreams taking flight</p>
			</header>
			<div class="ideas-grid">
				<article class="idea-card animate-on-scroll fade-left animate-delay-1">
					<img class="idea-photo" src="images/Daguplo.webp" alt="Erica Dagulo">
					<span class="idea-corner" aria-hidden="true">🍀</span>
					<div class="idea-content">
						<p class="idea-tag">EMERGING</p>
						<h4 class="idea-name">ERICA DAGULO</h4>
						<p class="idea-role">1st Year Class Representative</p>
						<p class="idea-desc">Erica found her voice through support and growth, and now empowers others to step into leadership.</p>
					</div>
				</article>
				<article class="idea-card animate-on-scroll fade-right animate-delay-2">
					<img class="idea-photo" src="images/Ronquillo.webp" alt="Jenmarc Ronquillo">
					<span class="idea-corner" aria-hidden="true">⭐</span>
					<div class="idea-content">
						<p class="idea-tag">RISING STAR</p>
						<h4 class="idea-name">JENMARC RONQUILLO</h4>
						<p class="idea-role">Internal Information Officer</p>
						<p class="idea-desc">Jenmarc strengthens communication and connection, keeping the organization engaged and united.</p>
					</div>
				</article>
			</div>
		</div>
	</section>

	<section class="awards-section" id="awards">
		<div class="awards-wrap">
			<header class="awards-head">
				<div class="awards-title-row">
					<h2 class="section-title">Women of Excellence</h2>
				</div>
				<p class="awards-subtitle">Shining stars in our constellation of achievement</p>
			</header>
			<div class="awards-grid">
				<article class="award-card animate-on-scroll fade-left animate-delay-1">
					<span class="award-mini-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="3.6"/><path d="M8.6 21V16.2l3.4-1.9 3.4 1.9V21"/></svg></span>
					<div class="award-title-row">
						<h4 class="award-name">Rhaya Quizana</h4>
						<p class="award-role">Best Organization Officer</p>
						<p class="award-desc">A leader driving innovation and impact.</p>
					</div>
				</article>
				<article class="award-card animate-on-scroll fade-right animate-delay-1">
					<span class="award-mini-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="3.6"/><path d="M8.6 21V16.2l3.4-1.9 3.4 1.9V21"/></svg></span>
					<div class="award-title-row">
						<h4 class="award-name">Stephanie De Villa</h4>
						<p class="award-role">Leader of the Year</p>
						<p class="award-desc">An inspiring role model with vision and strength.</p>
					</div>
				</article>
				<article class="award-card animate-on-scroll fade-left animate-delay-1">
					<span class="award-mini-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="3.6"/><path d="M8.6 21V16.2l3.4-1.9 3.4 1.9V21"/></svg></span>
					<div class="award-title-row">
						<h4 class="award-name">Mary-Ann Sinfuego</h4>
						<p class="award-role">Top Contributor Member</p>
						<p class="award-desc">A consistent force uplifting the organization.</p>
					</div>
				</article>
				<article class="award-card animate-on-scroll fade-right animate-delay-1">
					<span class="award-mini-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="3.6"/><path d="M8.6 21V16.2l3.4-1.9 3.4 1.9V21"/></svg></span>
					<div class="award-title-row">
						<h4 class="award-name">Ariane Jasmine Lelis</h4>
						<p class="award-role">Servant Leader Award</p>
						<p class="award-desc">Leads with purpose, humility, and service.</p>
					</div>
				</article>
			</div>
		</div>
	</section>

	<section class="empower-section" id="empowering">
		<div class="empower-wrap">
			<h2 class="section-title">Women Guiding EXPLICIT</h2>
			<p class="empower-intro">Behind every empowered student is a mentor who believed in them first. These women play a vital role in shaping knowledge, confidence, and future leaders within EXPLICIT.</p>
			<div class="empower-grid">
				<?php foreach ($mentorCards as $index => $mentor): ?>
	<article class="empower-card animate-on-scroll 
		<?= $index % 2 === 0 ? 'fade-left animate-delay-1' : 'fade-right animate-delay-2' ?>">
						<div class="empower-avatar">
							<img src="images/<?= htmlspecialchars((string) $mentor['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?= htmlspecialchars($mentor['name'], ENT_QUOTES, 'UTF-8'); ?>">
						</div>
						<div class="empower-meta">
							<h4 class="empower-name"><?= htmlspecialchars($mentor['name'], ENT_QUOTES, 'UTF-8'); ?></h4>
							<p class="empower-role"><?= htmlspecialchars($mentor['focus'], ENT_QUOTES, 'UTF-8'); ?></p>
							<p class="empower-text"><?= htmlspecialchars($mentor['description'], ENT_QUOTES, 'UTF-8'); ?></p>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="story-preview-section" id="her-story">
		<div class="story-preview-wrap">
			<h2 class="section-title">HER STORY</h2>
			<article class="story-preview-card animate-on-scroll fade-left animate-delay-1">
				<div>
					<div class="story-preview-photo">
						<?php if ($herStoryImage !== null): ?>
							<img src="images/<?= htmlspecialchars((string) $herStoryImage, ENT_QUOTES, 'UTF-8'); ?>" alt="Michelle Angelica V. Reyes">
						<?php else: ?>
							<div style="width:100%;height:100%;background:linear-gradient(145deg,#5a247a,#3a1657);"></div>
						<?php endif; ?>
					</div>
					<p class="story-preview-name">Michelle Angelica V. Reyes</p>
				</div>
				<div class="story-preview-text">
					<ul class="story-preview-list">
						<li>Meet Michelle</li>
						<li>Rising About Self - Doubt</li>
						<li>Redefining self</li>
						<li>A Voice of Encouragement</li>
						<li>Shaping the Future</li>
						<li>Achievements</li>
					</ul>
					<a class="story-preview-cta" href="her-story.php">Know Her Story</a>
				</div>
			</article>
		</div>
	</section>

	<section class="contact-section" id="contact">
		<div class="contact-wrap">
			<h3 class="contact-title">Get in Touch</h3>
			<div class="contact-card">
				<div class="contact-icon" aria-hidden="true">
					<svg width="46" height="46" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 7.5C4 6.12 5.12 5 6.5 5H17.5C18.88 5 20 6.12 20 7.5V16.5C20 17.88 18.88 19 17.5 19H6.5C5.12 19 4 17.88 4 16.5V7.5Z" stroke="currentColor" stroke-width="1.8"/><path d="M4.8 7.4L11.1 12.45C11.63 12.87 12.37 12.87 12.9 12.45L19.2 7.4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
				</div>
				<p class="contact-intro">Have questions or want to join our community? We'd love to hear from you!</p>
				<form class="contact-form" action="#" method="post">
					<div class="form-group">
						<label for="contactName">Name</label>
						<input id="contactName" name="name" type="text" placeholder="Your name">
					</div>
					<div class="form-group">
						<label for="contactEmail">Email</label>
						<input id="contactEmail" name="email" type="email" placeholder="your.email@example.com">
					</div>
					<div class="form-group">
						<label for="contactMessage">Message</label>
						<textarea id="contactMessage" name="message" placeholder="Tell us your thoughts..."></textarea>
					</div>
					<button class="contact-submit" type="submit">Send Message</button>
				</form>
			</div>
		</div>
	</section>

	<footer class="site-footer" id="footer">
		<div class="footer-wrap">
			<div class="footer-main">
				<div class="footer-brand">
					<h4>Explicitly Her</h4>
					<p>Together, these women are not just part of Explicitly Her - they are defining its future through innovation, resilience, and leadership.</p>
				</div>
			</div>
			<div class="footer-bottom">&copy; <?= date('Y'); ?> Explicitly Her. All rights reserved.</div>
			</div>
		</div>
	</footer>

	<div class="page-nav-arrows" aria-label="Page navigation">
		<button class="arrow-btn" id="arrowUp" type="button" aria-label="Go to previous section">↑</button>
		<button class="arrow-btn" id="arrowDown" type="button" aria-label="Go to next section">↓</button>
	</div>

	<div class="member-modal" id="memberModal" aria-hidden="true">
		<div class="modal-panel" role="dialog" aria-modal="true" aria-labelledby="modalName">
			<button class="modal-close" type="button" id="modalClose" aria-label="Close">×</button>
			<div class="modal-top">
				<span class="info-badge" id="modalBadge"></span>
				<div class="info-avatar"><img id="modalImage" src="" alt=""></div>
				<h4 class="info-name" id="modalName"></h4>
				<p class="info-role" id="modalRole"></p>
			</div>
			<p class="modal-intro" id="modalIntro"></p>
			<p class="modal-subtitle">Key Achievements:</p>
			<ul class="modal-points" id="modalPoints"></ul>
		</div>
	</div>

	<script>
		const cards = document.querySelectorAll('.info-card');
		const modal = document.getElementById('memberModal');
		const modalClose = document.getElementById('modalClose');
		const modalBadge = document.getElementById('modalBadge');
		const modalImage = document.getElementById('modalImage');
		const modalName = document.getElementById('modalName');
		const modalRole = document.getElementById('modalRole');
		const modalIntro = document.getElementById('modalIntro');
		const modalPoints = document.getElementById('modalPoints');
		const arrowUp = document.getElementById('arrowUp');
		const arrowDown = document.getElementById('arrowDown');
		const pageSections = Array.from(document.querySelectorAll('main[id], section[id], footer[id]'));

		/* ===== SCROLL ANIMATION ===== */
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('show');
        } else {
            entry.target.classList.remove('show');
        }
    });
}, { threshold: 0.2 });

document.querySelectorAll('.animate-on-scroll').forEach(el => {
    observer.observe(el);
});

document.querySelectorAll('.award-card').forEach(card => {
    card.addEventListener('mousemove', e => {
        const rect = card.getBoundingClientRect();
        const x = ((e.clientX - rect.left) / rect.width) * 100;
        const y = ((e.clientY - rect.top) / rect.height) * 100;

        card.style.setProperty('--x', x + '%');
        card.style.setProperty('--y', y + '%');
    });
});

		function openModal(card) {
			let points = [];
			try {
				points = JSON.parse(card.dataset.points || '[]');
			} catch (e) {
				points = [];
			}

			modalBadge.textContent = card.dataset.badge || '';
			modalImage.src = card.dataset.image || '';
			modalImage.alt = card.dataset.name || 'Member image';
			modalName.textContent = card.dataset.name || '';
			modalRole.textContent = card.dataset.role || '';
			modalIntro.textContent = card.dataset.detail || '';

			modalPoints.innerHTML = '';
			points.forEach((point) => {
				const li = document.createElement('li');
				li.textContent = point;
				modalPoints.appendChild(li);
			});

			modal.classList.add('open');
			modal.setAttribute('aria-hidden', 'false');
			document.body.style.overflow = 'hidden';
		}

		function closeModal() {
			modal.classList.remove('open');
			modal.setAttribute('aria-hidden', 'true');
			document.body.style.overflow = '';
		}

		cards.forEach((card) => {
			card.addEventListener('click', () => openModal(card));
			card.addEventListener('keydown', (event) => {
				if (event.key === 'Enter' || event.key === ' ') {
					event.preventDefault();
					openModal(card);
				}
			});
		});

		modalClose.addEventListener('click', closeModal);
		modal.addEventListener('click', (event) => {
			if (event.target === modal) {
				closeModal();
			}
		});

		document.addEventListener('keydown', (event) => {
			if (event.key === 'Escape' && modal.classList.contains('open')) {
				closeModal();
			}
		});

		function getCurrentSectionIndex() {
			const pivot = window.scrollY + (window.innerHeight * 0.35);
			let index = 0;
			pageSections.forEach((section, i) => {
				if (section.offsetTop <= pivot) {
					index = i;
				}
			});
			return index;
		}

		function scrollToSection(index) {
			if (index < 0 || index >= pageSections.length) {
				return;
			}
			pageSections[index].scrollIntoView({ behavior: 'smooth', block: 'start' });
		}

		arrowUp.addEventListener('click', () => {
			scrollToSection(getCurrentSectionIndex() - 1);
		});

		arrowDown.addEventListener('click', () => {
			scrollToSection(getCurrentSectionIndex() + 1);
		});
		document.querySelectorAll('.award-card, .info-card, .empower-card').forEach(card => {
    card.addEventListener('mousemove', e => {
        const rect = card.getBoundingClientRect();

        const x = (e.clientX - rect.left) / rect.width - 0.5;
        const y = (e.clientY - rect.top) / rect.height - 0.5;

        card.style.transform = `
            perspective(800px)
            rotateX(${y * -10}deg)
            rotateY(${x * 10}deg)
            scale(1.03)
        `;
    });

    card.addEventListener('mouseleave', () => {
        card.style.transform = '';
    });
});
		
	</script>
</body>
</html>
