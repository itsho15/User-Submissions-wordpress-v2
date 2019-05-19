<h3>You have a new contact from enquirey!</h3><br>

<p>
  <strong>Name:</strong><?= $name ?>
</p>

<p>
  <strong>email:</strong>
  <a href="mailto:<?= $email ?>"><?= $email ?></a>
</p>

<p>
  <strong>Skills:</strong><br>
  <ul>
    <?php foreach($skills as $skill): ?>
      <li>
        <?= $skill ?>
      </li>
    <?php endforeach;?>
  </ul>
</p>