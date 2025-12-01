<?php

declare(strict_types=1);

// --------------------------------------------------------------------------------------------------
// This script outputs a JSON array of all timezones (like "America/Chicago") that PHP supports.
//
// Requires PHP 5.2.0 or higher.
// --------------------------------------------------------------------------------------------------

echo json_encode(DateTimeZone::listIdentifiers());
