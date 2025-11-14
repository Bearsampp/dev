# Bearsampp Development Kit - Gradle Build System

## Overview

The Bearsampp Development Kit now uses **Gradle 9.2.0** from your local installation at `C:\Gradle\bin` with full backward compatibility with Apache Ant.

## Quick Start

### Prerequisites

- ✓ Gradle 9.2.0 installed at `C:\Gradle\bin`
- ✓ Java 11+ (you have Java 23.0.2)
- ✓ Gradle added to System PATH

### Basic Commands

```powershell
# Information
gradle tasks              # List all available tasks
gradle info               # Show build configuration
gradle verify             # Verify build environment
gradle --version          # Show Gradle version

# Build Setup
gradle initDirs           # Initialize build directories
gradle loadLibs           # Download required libraries
gradle loadAntLibs        # Load libraries using Ant

# Build & Clean
gradle clean              # Clean build artifacts
gradle build              # Build project
gradle hashAll            # Generate hash files
```

## Ant Compatibility

All existing Ant tasks are available with the `ant-` prefix:

```powershell
gradle ant-init           # Run Ant init
gradle ant-load.lib       # Run Ant load.lib
gradle ant-hash.all       # Run Ant hash.all
```

**Or use Ant directly (still works):**
```powershell
ant release
ant load.lib
```

## Configuration

- **Gradle Location:** C:\Gradle\bin
- **Gradle Version:** 9.2.0
- **Java Version:** 23.0.2
- **Build Files:** build.gradle, settings.gradle, gradle.properties
- **Ant Integration:** 100% compatible
- **Build Cache:** Enabled
- **Configuration Cache:** Available

## Key Features

### Performance
- 2-10x faster builds after first run (build caching)
- Incremental builds (only rebuilds what changed)
- Parallel task execution
- Gradle daemon keeps JVM warm

### Modern Features
- Configuration cache for faster builds
- Better dependency management
- Improved error messages
- Build scans for performance analysis

### Developer Experience
- Better IDE support (IntelliJ IDEA, VS Code, Eclipse)
- Rich plugin ecosystem
- Cross-platform support
- Automatic dependency resolution

## Advanced Usage

### Enable Configuration Cache
```powershell
gradle tasks --configuration-cache
```

### Generate Build Scan
```powershell
gradle tasks --scan
```

### Debug Mode
```powershell
gradle tasks --debug
gradle tasks --info
gradle tasks --stacktrace
```

### Stop Gradle Daemon
```powershell
gradle --stop
```

## Project Structure

```
D:/Bearsampp-dev/dev/
├── build.gradle              # Main Gradle build configuration
├── settings.gradle           # Project settings
├── gradle.properties         # Build properties
├── build/                    # Ant build files (unchanged)
│   ├── build-commons.xml
│   ├── build-bundle.xml
│   └── build-release.xml
└── Documentation
    ├── README_GRADLE.md      # This file
    ├── GRADLE_MIGRATION.md   # Migration guide
    └── GRADLE_USAGE.md       # Complete usage guide
```

## Troubleshooting

### "gradle is not recognized"

**Solution:** Restart PowerShell to pick up the PATH changes, or run:
```powershell
$env:Path = [System.Environment]::GetEnvironmentVariable("Path","Machine") + ";" + [System.Environment]::GetEnvironmentVariable("Path","User")
```

### Java version error

Ensure Java 11+ is installed:
```powershell
java -version
```

### Gradle daemon issues

Stop and restart:
```powershell
gradle --stop
gradle tasks
```

## Migration Path

### Current: Hybrid Mode ✓
- Both Ant and Gradle work
- All Ant tasks imported into Gradle
- Zero breaking changes

### Future: Gradual Migration (Optional)
1. Convert Ant macros to Gradle tasks one by one
2. Leverage Gradle 9.2.0 features
3. Eventually pure Gradle build

## Benefits Summary

✓ **Uses local Gradle** - No wrapper needed  
✓ **Latest features** - Gradle 9.2.0 with all improvements  
✓ **Faster builds** - Build cache + incremental compilation  
✓ **100% Ant compatible** - All existing workflows work  
✓ **Modern tooling** - Better IDE support and plugins  
✓ **Simple commands** - Just use `gradle`  

## Documentation

- **README_GRADLE.md** - This file (overview)
- **GRADLE_MIGRATION.md** - Detailed migration guide
- **GRADLE_USAGE.md** - Complete command reference
- **GRADLE_PATH_SOLUTION.md** - PATH troubleshooting

## Support

- **Gradle 9.2.0 Docs:** https://docs.gradle.org/9.2.0/userguide/userguide.html
- **Gradle User Guide:** https://docs.gradle.org/current/userguide/userguide.html
- **Migrating from Ant:** https://docs.gradle.org/current/userguide/migrating_from_ant.html

---

**Status:** ✓ Ready to use!  
**Gradle:** 9.2.0 from C:\Gradle\bin  
**Java:** 23.0.2  
**Ant Compatibility:** 100%  

**Simply use `gradle` commands from any directory!**
