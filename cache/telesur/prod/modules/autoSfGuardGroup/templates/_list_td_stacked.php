<td colspan="3">
  <?php echo __('%%id%% - %%name%% - %%description%%', array('%%id%%' => link_to($sf_guard_group->getId(), 'sf_guard_group_edit', $sf_guard_group), '%%name%%' => $sf_guard_group->getName(), '%%description%%' => $sf_guard_group->getDescription()), 'messages') ?>
</td>
