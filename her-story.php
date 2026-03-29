<?php
$storyImagePaths = glob(__DIR__ . '/images/*.{jpg,jpeg,png,webp,JPG,JPEG,PNG,WEBP}', GLOB_BRACE);
if ($storyImagePaths === false) {
	$storyImagePaths = [];
}

function pickStoryImage(array $imagePaths, array $needles): ?string
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
	return null;
}

$storyPrimaryImage = pickStoryImage($storyImagePaths, ['mich1']);
if ($storyPrimaryImage === null) {
	$storyPrimaryImage = pickStoryImage($storyImagePaths, ['michelle']);
}
if ($storyPrimaryImage === null && isset($storyImagePaths[0])) {
	$storyPrimaryImage = basename($storyImagePaths[0]);
}

$storySecondaryImage = pickStoryImage($storyImagePaths, ['mich2']);
if ($storySecondaryImage === null && isset($storyImagePaths[1])) {
	$storySecondaryImage = basename($storyImagePaths[1]);
}
if ($storySecondaryImage === null) {
	$storySecondaryImage = $storyPrimaryImage;
}

$storyRedefiningImage = pickStoryImage($storyImagePaths, ['mich3']);
if ($storyRedefiningImage === null && isset($storyImagePaths[2])) {
	$storyRedefiningImage = basename($storyImagePaths[2]);
}
if ($storyRedefiningImage === null) {
	$storyRedefiningImage = $storySecondaryImage;
}

$storyVoiceImage = pickStoryImage($storyImagePaths, ['mich4']);
if ($storyVoiceImage === null && isset($storyImagePaths[3])) {
	$storyVoiceImage = basename($storyImagePaths[3]);
}
if ($storyVoiceImage === null) {
	$storyVoiceImage = $storyRedefiningImage;
}

$storyFutureImage = pickStoryImage($storyImagePaths, ['mich5']);
if ($storyFutureImage === null) {
	$storyFutureImage = pickStoryImage($storyImagePaths, ['michelle7']);
}
if ($storyFutureImage === null) {
	$storyFutureImage = $storyVoiceImage;
}

$storyAchievementsImage = pickStoryImage($storyImagePaths, ['michelle7']);
if ($storyAchievementsImage === null) {
	$storyAchievementsImage = pickStoryImage($storyImagePaths, ['michelle']);
}
if ($storyAchievementsImage === null) {
	$storyAchievementsImage = $storyFutureImage;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Her Story - Michelle</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
	<style>
   :root {
    --bg-top: #1a0a2e;
    --bg-mid: #160826;
    --bg-bottom: #0f0520;
    --card-bg: rgba(32, 10, 50, 0.86);
    --card-border: rgba(192, 132, 252, 0.28);
    --text-main: #f0e2ff;
    --text-soft: rgba(243, 229, 255, 0.92);
    --title: #e6ccff;
}

* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    min-height: 100vh;
    font-family: "Poppins", sans-serif;
    color: var(--text-main);
    background:
        radial-gradient(circle at 20% 16%, rgba(107, 26, 107, 0.22), transparent 34%),
        radial-gradient(circle at 80% 86%, rgba(122, 31, 122, 0.2), transparent 36%),
        linear-gradient(145deg, var(--bg-top) 0%, var(--bg-mid) 52%, var(--bg-bottom) 100%);
    padding: 20px;
}

.story-page {
    width: min(1260px, 98vw);
    margin: 0 auto;
    display: grid;
    gap: 18px;
}

.story-block {
    border: 2px solid rgba(230, 199, 255, 0.78);
    background:
        radial-gradient(circle at 20% 22%, rgba(215, 170, 244, 0.2), transparent 36%),
        radial-gradient(circle at 80% 78%, rgba(186, 122, 230, 0.2), transparent 38%),
        linear-gradient(160deg, #2a0b41 0%, #3d0f5b 62%, #55156e 100%);
    padding: 18px 34px 30px;
}

.story-title,
.block-title {
    text-align: center;
    font-size: clamp(22px, 3.6vw, 32px);
    font-weight: 700;
    color: var(--title);

    margin-top: 20px;      /* 🔥 adds space above */
    margin-bottom: 8px;   /* 🔥 more space below */
    
    letter-spacing: 0.5px; /* subtle spacing */
}


.story-layout,
.story-layout-reverse {
    display: grid;
    grid-template-columns: 1.2fr 0.9fr;
    gap: 34px;
    align-items: center;
}

.story-layout-reverse {
    grid-template-columns: 0.9fr 1.2fr;
}


.achievements-layout {
    display: grid;
    grid-template-columns: 490px 1fr; 
    gap: 34px;
    align-items: center;
}


.story-photo {
    width: 100%;
    border-radius: 40px;
    overflow: hidden;
    background: var(--card-bg);
    border: 2px solid var(--card-border);
    box-shadow: 0 18px 20px rgba(8, 2, 16, 0.4);
}

.story-photo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* ===== TEXT ===== */
.story-text {
    font-size: clamp(14px, 1.2vw, 20px);
    line-height: 1.5;
    color: var(--text-soft);
    text-align: justify;
}

.story-text p {
    margin-bottom: 38px; /* more breathing room */
}

.story-text p:last-child {
    margin-bottom: 0; /* remove extra space at bottom */
}

.achievements-list {
    font-size: clamp(16px, 1.2vw, 22px);
    line-height: 1.6;
    padding-left: 20px;
}

.achievements-list li {
    margin-bottom: 60px;
}


.story-photo-name {
    margin-top: 10px;
    font-size: clamp(10px, 2vw, 20px);
    text-align: center;
}

.story-btn {
    display: inline-block;
    padding: 14px 28px;
    border-radius: 30px;
    border: 2px solid rgba(255, 255, 255, 0.3);

    color: white;
    text-decoration: none;
    font-weight: 600;
    font-size: 16px;

    background: rgba(255, 255, 255, 0.08);
    backdrop-filter: blur(6px);

    transition: all 0.3s ease;
}


.story-btn:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(-2px);
}


.story-actions {
    text-align: center;
    margin-top: 20px;
}


@media (max-width: 960px) {
    .story-layout,
    .story-layout-reverse,
    .achievements-layout {
        grid-template-columns: 1fr;
    }

    .story-photo {
        max-width: 260px;
        margin: 0 auto;
    }
	
}


.story-btn {
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


.story-btn:hover {
    transform: translateY(-2px);

    box-shadow:
        0 0 18px rgba(168, 85, 247, 0.45),
        0 0 40px rgba(168, 85, 247, 0.25),
        0 0 60px rgba(168, 85, 247, 0.15);
}

.story-title {
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
        0 0 12px rgba(192, 132, 252, 0.7),
        0 0 25px rgba(168, 85, 247, 0.5);
}

.block-title {
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
        0 0 10px rgba(192, 132, 252, 0.6),
        0 0 20px rgba(168, 85, 247, 0.4);
}

.story-block {
    position: relative;
    border-radius: 20px;
    border: 1px solid rgba(192, 132, 252, 0.35);

    box-shadow:
        0 0 15px rgba(192, 132, 252, 0.25),
        0 0 40px rgba(192, 132, 252, 0.15);

    transition: all 0.4s ease;
}

.story-block:hover {
    box-shadow:
        0 0 25px rgba(192, 132, 252, 0.5),
        0 0 70px rgba(192, 132, 252, 0.3),
        0 0 120px rgba(192, 132, 252, 0.2);
}

.story-block::before {
    content: "";
    position: absolute;
    inset: -20px;
    border-radius: 30px;

    background: radial-gradient(circle, rgba(192,132,252,0.2), transparent 70%);
    filter: blur(25px);
    z-index: -1;
}


.story-photo img {
    transition: transform 0.4s ease, filter 0.4s ease;
}

.story-photo-wrap:hover img {
    transform: scale(1.03);
    filter: brightness(1.05);
}

.story-photo-name {
    color: #e9d5ff;

    text-shadow:
        0 0 6px rgba(192, 132, 252, 0.7),
        0 0 14px rgba(192, 132, 252, 0.5),
        0 0 28px rgba(192, 132, 252, 0.3);

    transition: all 0.3s ease;
}

.story-photo-name:hover {
    text-shadow:
        0 0 10px rgba(192, 132, 252, 1),
        0 0 25px rgba(192, 132, 252, 0.8),
        0 0 50px rgba(192, 132, 252, 0.6);
}

.story-photo-name {
    animation: nameGlow 2.5s ease-in-out infinite alternate;
}

@keyframes nameGlow {
    from {
        text-shadow:
            0 0 6px rgba(192, 132, 252, 0.6),
            0 0 12px rgba(192, 132, 252, 0.4);
    }
    to {
        text-shadow:
            0 0 12px rgba(192, 132, 252, 1),
            0 0 28px rgba(192, 132, 252, 0.7),
            0 0 50px rgba(192, 132, 252, 0.5);
    }
}
/* ===== SCROLL ANIMATION BASE ===== */
.animate {
    opacity: 0;
    transform: translateY(80px) scale(0.95);
    filter: blur(8px);

    transition:
        opacity 0.9s ease,
        transform 0.9s cubic-bezier(0.22, 1, 0.36, 1),
        filter 0.9s ease;
}

.animate.show {
    opacity: 1;
    transform: translateY(0) scale(1);
    filter: blur(0);
}

/* directions */
.fade-left {
    transform: translateX(-60px) translateY(80px) scale(0.95);
}

.fade-right {
    transform: translateX(60px) translateY(80px) scale(0.95);
}

/* delays */
.delay-1 { transition-delay: 0.15s; }
.delay-2 { transition-delay: 0.3s; }
.delay-3 { transition-delay: 0.45s; }


</style>
</head>
<body>
	<main class="story-page">
		<section class="story-block animate">
			<h1 class="story-title">Michelle Angelica V. Reyes | 4th Year BS IT Student</h1>
			<div class="story-layout">
				<div class="story-text animate fade-left delay-1">
                    </p>Michelle didn't always envision herself in the world of technology. In fact, her path to tech began as a leap of faith, one shaped by practicality and guided by her mother's encouragement. Initially holding onto a different dream, Michelle entered the BSIT program unsure of where she truly belonged.</p>

<p>At the start, she felt out of place. Without a background in ICT and not seeing herself as "techy," she questioned whether she had made the right choice. But as she moved forward, her perspective began to shift. Michelle discovered that technology was more than just coding; it was a space where creativity, problem-solving, and innovation could thrive. It was in UI/UX design that she found her niche, where she could merge her artistic instincts with technical skills and finally feel at home.</p>
</div>
				<div class="story-photo-wrap animate fade-right delay-2">
					<div class="story-photo">
						<?php if ($storyPrimaryImage !== null): ?>
							<img src="images/<?= htmlspecialchars((string) $storyPrimaryImage, ENT_QUOTES, 'UTF-8'); ?>" alt="Michelle Angelica V. Reyes">
						<?php else: ?>
							<div class="story-fallback"></div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</section>

		<section class="story-block animate">
			<h2 class="block-title">Rising Above Self-Doubt</h2>
			<div class="story-layout-reverse">
				<div class="story-photo-wrap animate fade-right delay-2">
					<div class="story-photo">
						<?php if ($storySecondaryImage !== null): ?>
							<img src="images/<?= htmlspecialchars((string) $storySecondaryImage, ENT_QUOTES, 'UTF-8'); ?>" alt="Rising Above Self-Doubt">
						<?php else: ?>
							<div class="story-fallback"></div>
						<?php endif; ?>
					</div>
				</div>
				<div class="story-text animate fade-left delay-1">
                    <p>Michelle's journey was not without its challenges. One of the most significant obstacles she faced was self-doubt. There were moments when she believed she might not make it through the program at all. Surrounded by peers who seemed more experienced and passionate about programming, she often felt like she was falling behind.</p>

<p>Understanding complex lessons, managing academic responsibilities, and balancing organizational commitments with personal life added to the pressure. Yet, instead of giving up, Michelle chose to persevere. She learned to ask for help, to lean on others, and to continuously remind herself of the reason she started.</p> 
</div>
			</div>
		</section>

		<section class="story-block animate">
			<h2 class="block-title">Redefining Success</h2>
			<div class="story-layout">
				<div class="story-text animate fade-left delay-1">
                    <p>Through competitions, leadership roles, and new experiences, Michelle gradually built her confidence. But for her, the true measure of success goes beyond awards and recognition.

One of her proudest achievements is simply making it this far, becoming a 4th year IT student despite all the doubts she once carried. It is a quiet but powerful victory that reflects her resilience and growth.</p>

<p>Another turning point in her journey was joining hackathons. Initially intimidated, Michelle believed these events were only for highly skilled programmers. However, when she finally took the risk, she discovered that hackathons were not just about coding, they were about ideas, collaboration, and problem-solving.

Through these experiences, she developed her pitching skills and gained the confidence to share her knowledge. Recently, she was given the opportunity to speak and inspire members of her organization by sharing her journey and insights on hackathon pitching, transforming from a hesitant beginner into a voice of inspiration for others.</p>
				</div>
				<div class="story-photo-wrap animate fade-right delay-2">
					<div class="story-photo">
						<?php if ($storyRedefiningImage !== null): ?>
							<img src="images/<?= htmlspecialchars((string) $storyRedefiningImage, ENT_QUOTES, 'UTF-8'); ?>" alt="Redefining Success">
						<?php else: ?>
							<div class="story-fallback"></div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</section>

		<section class="story-block animate">
			<h2 class="block-title">A Voice of Encouragement</h2>
			<div class="story-layout-reverse">
				<div class="story-photo-wrap">
					<div class="story-photo">
						<?php if ($storyVoiceImage !== null): ?>
							<img src="images/<?= htmlspecialchars((string) $storyVoiceImage, ENT_QUOTES, 'UTF-8'); ?>" alt="A Voice of Encouragement">
						<?php else: ?>
							<div class="story-fallback"></div>
						<?php endif; ?>
					</div>
				</div>
				<div class="story-text animate fade-left delay-1">
                    <p>Michelle's story is not just about personal growth, it is also about empowering others who may feel lost or uncertain in their own journeys.

                    She believes that no one needs to have everything figured out from the start. In a field as vast as technology, there is always space to explore and discover one's strengths. For Michelle, growth came from stepping outside her comfort zone, joining competitions, trying new experiences, and embracing challenges.</p>

                    <p>She also emphasizes the importance of having a strong support system. The encouragement and presence of friends played a vital role in helping her push beyond her limits and continue moving forward.

                    Above all, Michelle carries a message grounded in faith, resilience, and self-belief: Trust God, trust yourself, and work smart. You'll get through it.</p>
				</div>
			</div>
		</section>

		<section class="story-block animate">
    <h2 class="block-title">Shaping the Future</h2>

    <!-- 👇 CHANGE HERE -->
    <div class="story-layout"> <!-- NOT story-layout-reverse -->

        <!-- 👇 TEXT FIRST -->
        <div class="story-text animate fade-left delay-1">
            <p>Michelle represents a new generation of women in tech, individuals who may not start with certainty, but who grow through courage, persistence, and openness to learning.</p>
            
            <p></p>
            
            <p>Her journey is a reminder that success in technology is not defined by where you begin, but by how willing you are to continue. Through her experiences, she is not only shaping her own future but also inspiring others to believe that they, too, have a place in tech.</p>
        </div>

        <!-- 👇 IMAGE SECOND -->
        <div class="story-photo-wrap animate fade-right delay-2">
            <div class="story-photo">
                <?php if ($storyFutureImage !== null): ?>
                    <img src="images/<?= htmlspecialchars((string) $storyFutureImage, ENT_QUOTES, 'UTF-8'); ?>" alt="Shaping the Future">
                <?php else: ?>
                    <div class="story-fallback"></div>
                <?php endif; ?>
            </div>
        </div>

    </div>
</section>

		<section class="story-block animate">
			<h2 class="block-title">Achievements</h2>
			<div class="story-layout achievements-layout">
				<div class="story-photo-wrap">
					<div class="story-photo achievements-photo">
						<?php if ($storyAchievementsImage !== null): ?>
							<img src="images/<?= htmlspecialchars((string) $storyAchievementsImage, ENT_QUOTES, 'UTF-8'); ?>" alt="Michelle Achievements">
						<?php else: ?>
							<div class="story-fallback"></div>
						<?php endif; ?>
					</div>
					<p class="story-photo-name">Michelle Angelica V. Reyes</p>
				</div>
				<ul class="achievements-list">
					<li>Champion, DOST Myth Smashers Nuclear Science Competition</li>
					<li>Champion, Sta. Rosa Ignite Hackathon 2025 (Government-Organized)</li>
					<li>Champion, FEU Create and Conquer Hackathon 2025</li>
					<li>3rd Place, 5th PUP Research Pitching Competition</li>
					<li>Breaking Enigma 2025 National Hackathon (DTI-NDC), Sustainability Track</li>
					<li>TOP 10 Finalist - Bangko Sentral ng Pilipinas YFI Hackathon</li>
				</ul>
			</div>
		</section>

		<footer class="story-footer">
			<div class="story-actions">
				<a class="story-btn" href="landing.php#her-story">Back to Landing Page</a>
			</div>
		</footer>
	</main>
    <script>
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('show');
        } else {
            entry.target.classList.remove('show'); // re-animate
        }
    });
}, { threshold: 0.2 });

document.querySelectorAll('.animate').forEach(el => {
    observer.observe(el);
});
</script>
</body>
</html>