<?php

$event = $data['event'] ?? null;

?>

<div class="page-content">

    <div class="page-header">

        <div>
            <p class="page-label">SCHOOL MANAGEMENT</p>

            <h1>Event Details</h1>

            <p>
                View the details of this school event.
            </p>
        </div>

        <div>
            <a href="<?= ROOT ?>/events">
                Back to Events
            </a>
        </div>

    </div>


    <?php if ($event): ?>

        <div class="details-card">

            <div class="details-header">

                <div>
                    <p class="details-label">EVENT</p>

                    <h2>
                        <?= htmlspecialchars($event->title) ?>
                    </h2>
                </div>

                <span>
                    <?= htmlspecialchars(ucfirst($event->status)) ?>
                </span>

            </div>


            <div class="details-grid">

                <div class="detail-item">

                    <label>Date</label>

                    <p>
                        <?= date('d F Y', strtotime($event->event_date)) ?>
                    </p>

                </div>


                <div class="detail-item">

                    <label>Time</label>

                    <p>

                        <?php if (!empty($event->start_time)): ?>

                            <?= date('h:i A', strtotime($event->start_time)) ?>

                            <?php if (!empty($event->end_time)): ?>

                                -
                                <?= date('h:i A', strtotime($event->end_time)) ?>

                            <?php endif; ?>

                        <?php else: ?>

                            —

                        <?php endif; ?>

                    </p>

                </div>


                <div class="detail-item">

                    <label>Location</label>

                    <p>
                        <?= !empty($event->location)
                            ? htmlspecialchars($event->location)
                            : '—'
                        ?>
                    </p>

                </div>


                <div class="detail-item">

                    <label>Created By</label>

                    <p>

                        <?php

                        $createdBy = trim(
                            ($event->firstname ?? '') . ' ' .
                            ($event->lastname ?? '')
                        );

                        ?>

                        <?= htmlspecialchars($createdBy ?: '—') ?>

                    </p>

                </div>

            </div>


            <div class="details-description">

                <label>Description</label>

                <p>
                    <?= !empty($event->description)
                        ? nl2br(htmlspecialchars($event->description))
                        : 'No description provided.'
                    ?>
                </p>

            </div>


            <div class="details-actions">

                <a href="<?= ROOT ?>/events/edit/<?= $event->event_id ?>">
                    Edit Event
                </a>

                <a href="<?= ROOT ?>/events">
                    Back to Events
                </a>

            </div>

        </div>

    <?php else: ?>

        <div class="empty-state">

            <h2>Event Not Found</h2>

            <p>
                The requested event could not be found.
            </p>

            <a href="<?= ROOT ?>/events">
                Back to Events
            </a>

        </div>

    <?php endif; ?>

</div>