@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../alrik11es/cowsayphp/bin/cowsayphp
php "%BIN_TARGET%" %*
