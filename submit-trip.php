<?php
require __DIR__.'/config.php';
$success = false; $error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 verify_csrf();
 $title=trim($_POST['title']??''); $destination=trim($_POST['destination']??''); $duration=trim($_POST['duration']??'');
 $price=(float)($_POST['price']??0); $image=trim($_POST['image_url']??''); $description=trim($_POST['description']??'');
 $name=trim($_POST['submitted_by']??''); $email=trim($_POST['contact_email']??'');
 if (!$title || !$destination || !$duration || !$description || !$name || !filter_var($email,FILTER_VALIDATE_EMAIL) || $price<0) $error='Please complete all required fields with a valid email.';
 else {
  $stmt=db()->prepare("INSERT INTO trips(title,destination,duration,price,image_url,description,submitted_by,contact_email,status) VALUES(?,?,?,?,?,?,?,?, 'pending')");
  $stmt->execute([$title,$destination,$duration,$price,$image ?: null,$description,$name,$email]);
  $success=true;
 }
}
?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Share a trip — Wanderly</title><link rel="stylesheet" href="assets/style.css"></head><body><header class="site-header"><a class="brand" href="index.php"><span class="brand-mark">W</span> wanderly<span>.</span></a><nav><a href="index.php">← Back to explore</a></nav></header><main class="form-page"><div class="form-intro"><span class="eyebrow">SHARE YOUR DISCOVERY</span><h1>Put a place<br><em>on the map.</em></h1><p>Tell the community about a trip worth taking. Your submission will appear after admin review.</p></div><form class="trip-form" method="post"><input type="hidden" name="csrf" value="<?=e(csrf_token())?>"><?php if($success): ?><div class="notice success">Thanks! Your trip was submitted and is awaiting approval.</div><?php elseif($error): ?><div class="notice"><?=e($error)?></div><?php endif; ?><div class="form-row"><div><label>Trip title *</label><input name="title" required placeholder="e.g. A quiet weekend in the mountains"></div><div><label>Destination *</label><input name="destination" required placeholder="e.g. Bali, Indonesia"></div></div><div class="form-row"><div><label>Duration *</label><input name="duration" required placeholder="e.g. 5 days / 4 nights"></div><div><label>Price per person (USD) *</label><input name="price" type="number" min="0" step="0.01" required placeholder="450"></div></div><label>Cover image URL</label><input name="image_url" type="url" placeholder="https://..."><label>Trip description *</label><textarea name="description" rows="6" required placeholder="What makes this trip special?"></textarea><div class="form-row"><div><label>Your name *</label><input name="submitted_by" required></div><div><label>Contact email *</label><input name="contact_email" type="email" required></div></div><button class="btn btn-primary btn-wide">Submit for review ↗</button><p class="muted">Your post is not public until an administrator approves it.</p></form></main><footer><a class="brand" href="index.php">wanderly<span>.</span></a><p>Made for curious people and beautiful places.</p></footer></body></html>
