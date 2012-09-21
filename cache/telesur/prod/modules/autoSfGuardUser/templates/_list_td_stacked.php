<td colspan="2">
  <?php echo __('%%username%% - %%last_login%%', array('%%username%%' => link_to($sf_guard_user->getUsername(), 'sf_guard_user_edit', $sf_guard_user), '%%last_login%%' => false !== strtotime($sf_guard_user->getLastLogin()) ? format_date($sf_guard_user->getLastLogin(), "f") : '&nbsp;'), 'messages') ?>
</td>
