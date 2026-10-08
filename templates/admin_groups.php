<h2>Groups</h2>
<p class="muted">A group owns links and contains users. People only see links created in their own group; super admins see every group.</p>

<div class="section">
    <h3>Create a group</h3>
    <form method="POST" action="<?= e(url_for('admin_groups')) ?>">
        <div class="form-group">
            <label>Group name</label>
            <input type="text" name="name" placeholder="Admissions" maxlength="<?= (int) GROUP_NAME_MAX_LENGTH ?>" required>
        </div>
        <button type="submit">Create group</button>
    </form>
</div>

<hr style="margin: 2rem 0; border:0; border-top:1px solid #ddd;">

<h3>All groups</h3>
<div class="table-scroll groups-table">
<table>
    <colgroup>
        <col style="width: 34%">
        <col style="width: 12%">
        <col style="width: 12%">
        <col style="width: 42%">
    </colgroup>
    <thead>
        <tr>
            <th>Name</th>
            <th>Members</th>
            <th>Links</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    <?php if (!empty($groups)): ?>
    <?php foreach ($groups as $g): ?>
        <?php $is_empty = (int) $g['member_count'] === 0 && (int) $g['link_count'] === 0; ?>
        <tr>
            <td><strong><?= e($g['name']) ?></strong></td>
            <td><?= (int) $g['member_count'] ?></td>
            <td><?= (int) $g['link_count'] ?></td>
            <td>
                <div style="display: flex; gap: 0.3rem; flex-wrap: wrap; align-items: center;">
                    <form method="POST" action="<?= e(url_for('admin_rename_group', ['group_id' => $g['id']])) ?>"
                          style="margin: 0; display: flex; gap: 0.3rem;">
                        <input type="text" name="name" value="<?= e($g['name']) ?>"
                               maxlength="<?= (int) GROUP_NAME_MAX_LENGTH ?>" required
                               style="width: 150px; padding: 0.3rem 0.4rem; font-size: 0.8rem;">
                        <button type="submit" class="btn-small">Rename</button>
                    </form>
                    <?php if ($is_empty): ?>
                    <form method="POST" action="<?= e(url_for('admin_delete_group', ['group_id' => $g['id']])) ?>"
                          onsubmit="return confirm('Delete the group <?= e($g['name']) ?>?');" style="margin: 0;">
                        <button type="submit" class="btn-small btn-danger">Delete</button>
                    </form>
                    <?php else: ?>
                    <span class="muted" style="font-size: 0.8rem;">Empty the group to delete it</span>
                    <?php endif; ?>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="4" class="muted">No groups yet. Create one above.</td></tr>
    <?php endif; ?>
    </tbody>
</table>
</div>
<div class="group-cards">
<?php if (!empty($groups)): ?>
<?php foreach ($groups as $g): ?>
    <?php $is_empty = (int) $g['member_count'] === 0 && (int) $g['link_count'] === 0; ?>
    <article class="group-card">
        <h4><?= e($g['name']) ?></h4>
        <p class="group-meta muted"><?= (int) $g['member_count'] ?> members · <?= (int) $g['link_count'] ?> links</p>
        <form class="group-rename" method="POST" action="<?= e(url_for('admin_rename_group', ['group_id' => $g['id']])) ?>">
            <label for="group-name-<?= (int) $g['id'] ?>">Name</label>
            <input type="text" id="group-name-<?= (int) $g['id'] ?>" name="name" value="<?= e($g['name']) ?>"
                   maxlength="<?= (int) GROUP_NAME_MAX_LENGTH ?>" required>
            <button type="submit">Rename</button>
        </form>
        <?php if ($is_empty): ?>
        <form method="POST" action="<?= e(url_for('admin_delete_group', ['group_id' => $g['id']])) ?>"
              onsubmit="return confirm('Delete the group <?= e($g['name']) ?>?');" style="margin: 0;">
            <button type="submit" class="btn-danger">Delete</button>
        </form>
        <?php else: ?>
        <p class="muted" style="margin: 0.6rem 0 0;">Empty the group to delete it</p>
        <?php endif; ?>
    </article>
<?php endforeach; ?>
<?php else: ?>
    <p class="muted">No groups yet. Create one above.</p>
<?php endif; ?>
</div>

<div class="auth-links">
    <p><a href="<?= e(url_for('admin_users')) ?>">Manage users</a></p>
</div>
