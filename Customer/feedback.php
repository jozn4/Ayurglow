<?php
include_once('header.php');
$psid=$_GET['psid'];
?>

<main class="main">
  <div class="container my-5">
    <h2 class="text-center mb-4">Send Your Feedback</h2>

    <form action="feedbackaction.php" method="post">
      <div class="mb-3">
        <label for="description" class="form-label">Your Feedback</label>
        <textarea name="description" id="description" rows="5" class="form-control" placeholder="Write your feedback here..." required></textarea>
      </div>
<input type="hidden" name="psid" value="<?php echo $psid ?>">
      <div class="text-center">
<button type="submit" name="submit" class="btn btn-primary">Submit Feedback</button>
      </div>
    </form>
  </div>
</main>

<?php
include_once('footer.php');
?>
