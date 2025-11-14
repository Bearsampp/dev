# How to Use Gradle - Complete Guide

## Current Situation

Gradle is installed at `C:\Gradle\bin` but is **NOT in your PATH**.

## Two Options

### Option 1: Use Full Path (Works Now)

Use the full path to gradle.bat:

```powershell
C:\Gradle\bin\gradle tasks
C:\Gradle\bin\gradle info
C:\Gradle\bin\gradle verify
C:\Gradle\bin\gradle release
```

**Example:**
```powershell
cd D:\Bearsampp-dev\dev
C:\Gradle\bin\gradle info
```

### Option 2: Add to PATH (Permanent Solution)

#### Step 1: Run PowerShell as Administrator

Right-click PowerShell → "Run as Administrator"

#### Step 2: Run the setup script

```powershell
cd D:\Bearsampp-dev\dev
.\add-gradle-to-path.ps1
```

#### Step 3: Restart PowerShell

Close and reopen PowerShell (or restart your computer)

#### Step 4: Test it

```powershell
gradle --version
gradle tasks
```

Now you can use `gradle` from anywhere!

## Manual PATH Setup (Alternative)

If the script doesn't work, add manually:

1. Press `Win + X` → System
2. Click "Advanced system settings"
3. Click "Environment Variables"
4. Under "System variables", find "Path"
5. Click "Edit"
6. Click "New"
7. Add: `C:\Gradle\bin`
8. Click "OK" on all dialogs
9. Restart PowerShell

## Quick Reference

### With Full Path (Works Now)
```powershell
# Information
C:\Gradle\bin\gradle tasks
C:\Gradle\bin\gradle info
C:\Gradle\bin\gradle verify
C:\Gradle\bin\gradle --version

# Build Setup
C:\Gradle\bin\gradle initDirs
C:\Gradle\bin\gradle loadLibs
C:\Gradle\bin\gradle loadAntLibs

# Build & Clean
C:\Gradle\bin\gradle clean
C:\Gradle\bin\gradle build
C:\Gradle\bin\gradle release
```

### After Adding to PATH
```powershell
# Information
gradle tasks
gradle info
gradle verify
gradle --version

# Build Setup
gradle initDirs
gradle loadLibs
gradle loadAntLibs

# Build & Clean
gradle clean
gradle build
gradle release
```

## Creating an Alias (Quick Fix)

Add this to your PowerShell profile for current session:

```powershell
# Create alias for current session
Set-Alias -Name gradle -Value C:\Gradle\bin\gradle.bat

# Now you can use:
gradle tasks
gradle info
```

To make it permanent, add to your PowerShell profile:

```powershell
# Open profile
notepad $PROFILE

# Add this line:
Set-Alias -Name gradle -Value C:\Gradle\bin\gradle.bat

# Save and restart PowerShell
```

## Troubleshooting

### "gradle is not recognized"

**Problem:** Gradle not in PATH

**Solutions:**
1. Use full path: `C:\Gradle\bin\gradle tasks`
2. Add to PATH (see above)
3. Create alias (see above)

### "Cannot find path"

**Problem:** Wrong directory

**Solution:**
```powershell
cd D:\Bearsampp-dev\dev
C:\Gradle\bin\gradle tasks
```

### Script execution error

**Problem:** PowerShell execution policy

**Solution:**
```powershell
# Run as Administrator
Set-ExecutionPolicy RemoteSigned -Scope CurrentUser
.\add-gradle-to-path.ps1
```

## Recommended Approach

**For immediate use:**
```powershell
C:\Gradle\bin\gradle tasks
```

**For permanent solution:**
1. Run `.\add-gradle-to-path.ps1` as Administrator
2. Restart PowerShell
3. Use `gradle` commands normally

## Verification

Check if Gradle is in PATH:

```powershell
# Check PATH
$env:PATH -split ';' | Select-String -Pattern 'Gradle'

# If it shows C:\Gradle\bin, you're good!
# If nothing shows, Gradle is not in PATH
```

Test Gradle:

```powershell
# With full path (always works)
C:\Gradle\bin\gradle --version

# Without path (only works if in PATH)
gradle --version
```

## Summary

| Method | Command | When to Use |
|--------|---------|-------------|
| Full Path | `C:\Gradle\bin\gradle tasks` | Works immediately, no setup |
| Add to PATH | `gradle tasks` | After running setup script |
| Alias | `gradle tasks` | Quick fix for current session |

---

**Current Status:** Gradle NOT in PATH  
**Quick Fix:** Use `C:\Gradle\bin\gradle` commands  
**Permanent Fix:** Run `.\add-gradle-to-path.ps1` as Administrator
