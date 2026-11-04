<?php
require __DIR__.'/config.php';
$q = trim($_GET['q'] ?? '');
$sql = "SELECT * FROM trips WHERE status='published'";
$params = [];
if ($q !== '') { $sql .= " AND (title LIKE ? OR destination LIKE ?)"; $params = ["%$q%","%$q%"]; }
$sql .= " ORDER BY created_at DESC";
$stmt = db()->prepare($sql); $stmt->execute($params); $trips = $stmt->fetchAll();
?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Wanderly — Find your next escape</title><link rel="stylesheet" href="assets/style.css"></head><body>
<header class="site-header"><a class="brand" href="index.php"><span class="brand-mark">W</span> wanderly<span>.</span></a><nav><a href="#trips">Explore</a><a href="submit-trip.php">List a trip</a><a href="admin-login.php">Admin</a></nav></header>
<main>
<section class="hero"><div class="hero-copy"><span class="eyebrow">YOUR NEXT STORY STARTS HERE</span><h1>Go somewhere<br><em>beautiful.</em></h1><p>Discover thoughtfully curated escapes and unforgettable places, shared by travelers who know them best.</p><form class="searchbar" method="get"><span>⌕</span><input name="q" value="<?=e($q)?>" placeholder="Where do you want to go?"><button class="btn btn-primary">Find trips</button></form><div class="hero-meta"><span>✦ 120+ destinations</span><span>✦ Community-curated</span></div></div><div class="hero-art"><div class="hero-image"></div><div class="floating-note"><span class="note-icon">✈</span><div><b>Take the scenic route</b><small>Collect moments, not miles.</small></div></div><div class="sun"></div><div class="hero-stamp">WANDER<br>MORE</div></div></section>
<section class="section" id="trips"><div class="section-heading"><div><span class="eyebrow">THE COMMUNITY EDIT</span><h2>Find your <em>next escape.</em></h2></div><a class="text-link" href="submit-trip.php">Share your destination ↗</a></div>
<div class="trip-grid"><?php if(!$trips): ?><div class="empty-state"><h3>No trips published yet</h3><p>Be the first to share a destination with the community.</p><a class="btn btn-primary" href="submit-trip.php">Submit a trip</a></div><?php endif; ?>
<?php foreach($trips as $trip): ?><article class="trip-card"><a class="trip-image" href="trip.php?id=<?=$trip['id']?>" style="background-image:url('<?=e($trip['image_url'] ?: 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=900&q=80')?>')"><span class="image-tag">COMMUNITY PICK</span></a><div class="trip-info"><div class="trip-location">⌖ <?=e($trip['destination'])?></div><h3><a href="trip.php?id=<?=$trip['id']?>"><?=e($trip['title'])?></a></h3><div class="trip-bottom"><span><?=e($trip['duration'])?></span><strong>$<?=number_format((float)$trip['price'],0)?><small> / person</small></strong></div></div></article><?php endforeach; ?></div></section>
<section class="cta-band"><div><span class="eyebrow">KNOW A PLACE WE SHOULD SEE?</span><h2>Your favorite trip could<br>inspire someone else's.</h2></div><a class="btn btn-light" href="submit-trip.php">Share your trip <span>↗</span></a></section>
</main><footer><a class="brand" href="index.php">wanderly<span>.</span></a><p>Made for curious people and beautiful places.</p><span>© <?=date('Y')?> Wanderly Travel</span></footer><script src="assets/app.js"></script></body></html>
