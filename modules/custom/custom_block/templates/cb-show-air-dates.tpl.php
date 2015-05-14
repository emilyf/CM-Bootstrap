<?php //dpm($content); ?>
<div class="air-dates-list">
  <h3>Upcoming Air Dates</h3>
  <ul class="air-dates">
    <?php foreach($content as $item): ?>
      <li>
        <?php
          $timestamp = strtotime($item[0]->field_airing_date['und'][0]['value']);
          $type = 'long';
        ?>
        <?php print format_date($timestamp, $type); ?>
      </li>
    <?php endforeach; ?>
  </ul>
</div>