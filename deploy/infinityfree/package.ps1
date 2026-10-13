[CmdletBinding()]
param()

$ErrorActionPreference = 'Stop'
$projectRoot = (Resolve-Path (Join-Path $PSScriptRoot '..\..\')).Path
$vendorAutoload = Join-Path $projectRoot 'vendor\autoload.php'

if (-not (Test-Path $vendorAutoload)) {
    throw 'Composer dependencies are missing. Run composer install --no-dev --optimize-autoloader first.'
}

$outputRoot = Join-Path $projectRoot 'deployment-output'
$packageName = 'infinityfree-' + (Get-Date -Format 'yyyyMMdd-HHmmss')
$packageRoot = Join-Path $outputRoot $packageName
$htdocs = Join-Path $packageRoot 'htdocs'
$core = Join-Path $htdocs 'core'

New-Item -ItemType Directory -Path $core -Force | Out-Null

$robocopy = Join-Path $env:SystemRoot 'System32\robocopy.exe'
$coreCopyArgs = @(
    $projectRoot,
    $core,
    '/E',
    '/R:2',
    '/W:1',
    '/XD',
    (Join-Path $projectRoot '.git'),
    (Join-Path $projectRoot 'node_modules'),
    (Join-Path $projectRoot 'tests'),
    (Join-Path $projectRoot 'public'),
    (Join-Path $projectRoot 'bootstrap\cache'),
    (Join-Path $projectRoot 'storage\app\public'),
    $outputRoot,
    (Join-Path $projectRoot 'storage\framework\cache'),
    (Join-Path $projectRoot 'storage\framework\sessions'),
    (Join-Path $projectRoot 'storage\framework\testing'),
    (Join-Path $projectRoot 'storage\framework\views'),
    (Join-Path $projectRoot 'storage\logs'),
    '/XF',
    '.env*',
    'auth.json',
    '.phpunit.result.cache',
    'database.sqlite'
)

& $robocopy @coreCopyArgs | Out-Null
if ($LASTEXITCODE -ge 8) {
    throw "Failed to copy Laravel application files (robocopy exit code $LASTEXITCODE)."
}

$htdocsCopyArgs = @(
    (Join-Path $projectRoot 'public'),
    $htdocs,
    '/E',
    '/R:2',
    '/W:1',
    '/XD',
    (Join-Path $projectRoot 'public\storage'),
    '/XF',
    'index.php',
    '.htaccess'
)

& $robocopy @htdocsCopyArgs | Out-Null
if ($LASTEXITCODE -ge 8) {
    throw "Failed to copy public assets (robocopy exit code $LASTEXITCODE)."
}

$uploadSource = Join-Path $projectRoot 'storage\app\public'
$uploadTarget = Join-Path $htdocs 'storage'
if (Test-Path $uploadSource) {
    & $robocopy $uploadSource $uploadTarget /E /R:2 /W:1 | Out-Null
    if ($LASTEXITCODE -ge 8) {
        throw "Failed to copy public uploads (robocopy exit code $LASTEXITCODE)."
    }
} else {
    New-Item -ItemType Directory -Path $uploadTarget -Force | Out-Null
}

$writableDirectories = @(
    'bootstrap\cache',
    'storage\app\private',
    'storage\framework\cache\data',
    'storage\framework\sessions',
    'storage\framework\testing',
    'storage\framework\views',
    'storage\logs'
)
foreach ($directory in $writableDirectories) {
    New-Item -ItemType Directory -Path (Join-Path $core $directory) -Force | Out-Null
}

Copy-Item (Join-Path $PSScriptRoot 'htdocs-index.php') (Join-Path $htdocs 'index.php')
Copy-Item (Join-Path $PSScriptRoot 'htdocs.htaccess') (Join-Path $htdocs '.htaccess')
Copy-Item (Join-Path $PSScriptRoot 'core.htaccess') (Join-Path $core '.htaccess')
Copy-Item (Join-Path $PSScriptRoot '.env.example') (Join-Path $core '.env.example')

Write-Output "InfinityFree package created: $packageRoot"
Write-Output "Upload the contents of: $htdocs"
