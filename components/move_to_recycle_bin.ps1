param (
    [string]$FilePath
)

# Ensure the file path is valid
if (-not (Test-Path -Path $FilePath)) {
    Write-Output "Error: File not found"
    exit 1
}

try {
    $recycleBin = [System.IO.Path]::GetTempPath() + [System.IO.Path]::GetRandomFileName() + ".bin"
    Move-Item -Path $FilePath -Destination $recycleBin -Force
    Write-Output "Success"
} catch {
    Write-Output "Error: $_"
    exit 1
}
