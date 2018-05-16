<html>
<head>
    <link rel="stylesheet" href="../adminStyle.css">
    <?php
    include 'reports.php';
    include '../../includes/links.php'
    ?>
</head>
<body>
<?php
include '../../includes/header.php';
?>
<!--display all reports-->
<div id="content">
    <table id="contentTable">
        <tr class="titleRow">
            <td>
                Username
            </td>
            <td>
                Reason of report
            </td>
            <td>
                Reported by
            </td>
            <td>
                Report description
            </td>
            <td>
                Reported at
            </td>
        </tr>
        <?php foreach ($results as $user_report) { ?>
            <tr class="userRow" onclick="window.location='../ban?id=<?php echo $user_report['user_id'] ?>'">
                <td>
                    <a class="userLink" href="http://localhost/Jukebox/profile/profile.php?id=<?php echo $user_report['user_id'] ?>"><?php echo strip_tags($functions->getUsername($user_report['user_id'])); ?></a>
                </td>
                <td>
                    <?php echo $functions->getReport($user_report['offense']); ?>
                </td>
                <td>
                    <a class="userLink" href="http://localhost/Jukebox/profile/profile.php?id=<?php echo $user_report['reported_by'] ?>"><?php echo strip_tags($functions->getUsername($user_report['reported_by'])); ?></a>
                </td>
                <td>
                    <?php echo strip_tags($user_report['report_comment']); ?>
                </td>
                <td>
                    <?php echo $user_report['created_at']; ?>
                </td>

            </tr>
        <?php } ?>
    </table>
</div>

<?php include '../../includes/footer.php'; ?>
</body>
</html>