<?php
function Headern($headerText, $dbContext)
{
    $auth = $dbContext->getUsersDatabase()->getAuth();
    $userEmail = null;

    if ($auth->isLoggedIn()) {
        $userEmail = $auth->getEmail();
    }
?>
    <header class="bg-dark bg-gradient py-2">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center" style="color: cadetblue;">
                <h5 class="display-4"><?php echo $headerText; ?></h5>
                <?php if ($userEmail): ?>
                    <p>Inloggad som: <strong><?php echo htmlspecialchars($userEmail); ?></strong></p>
                <?php endif; ?>
            </div>
        </div>
    </header>
<?php
}
?>