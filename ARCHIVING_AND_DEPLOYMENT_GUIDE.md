# CDSO Maintenance Reporting System — Updated Build

## Included changes
- Account archiving using the existing users soft-delete field, plus archived-account search and restore.
- Maintenance request archiving restricted to `completed` and `rejected` statuses, plus restore while preserving status and request history.
- Administrator and Super Admin account-creation routes; public `/signup` redirects to login.
- Dashboard status totals combined into one aggregate query, period-result caching in the browser, and date/status indexes.
- Recurring problem-location analytics.
- Mobile-responsive inventory add-material button and modal footer.
- Print action calls the browser print dialog directly from the user's click for improved mobile compatibility.

## Important deployment note
The uploaded source archive did not include a root-level `Dockerfile`, although your previous Render deployment history showed Dockerfile-based deployments. Do not replace the connected GitHub repository wholesale with this archive until you compare the existing repository deployment files and preserve the currently working Render build configuration. This archive is intended for review and controlled integration, not a blind production overwrite.

## Before deployment
1. Back up the production database and keep the current deployed commit available for rollback.
2. Configure environment variables in Render; this archive intentionally excludes `.env` and Git history. Do not upload a local `.env` file.
3. Test the project against a separate/staging database first.
4. Run `php artisan migrate --force` only after backing up the database and confirming the target database. This adds `deleted_at` to maintenance requests and performance indexes; it does not delete existing rows.
5. Run `php artisan route:list` and test login, all four roles, request creation/assignment/completion, inventory usage, archive/restore, dashboard periods, and print on desktop and mobile.
6. Merge/deploy only after these checks pass.

## Archiving behavior
- Accounts are soft-deleted. Their request history remains in the database, and the default authentication query excludes archived accounts.
- Requests can only be archived when completed or rejected. Restoring a request preserves its terminal status and adds a restore log.
- Archived records are excluded from active lists and normal request analytics by Laravel's soft-delete scope.

## Validation performed for this package
- PHP syntax lint on project PHP files.
- JavaScript syntax check for the administrator dashboard script.

This is a source-code package; deployment/runtime integration still needs to be tested with the configured database and Render environment before production release.
