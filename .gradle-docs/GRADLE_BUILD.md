# Bearsampp - Pure Gradle Build

This project uses a **Pure Gradle** build system with no Ant dependencies.

## 📚 Documentation

All Gradle documentation has been moved to **`.gradle-docs/`** directory:

- **[INDEX.md](INDEX.md)** - Documentation index and navigation
- **[README.md](README.md)** - Overview and quick start
- **[USAGE.md](USAGE.md)** - Complete usage guide
- **[TASKS.md](TASKS.md)** - Detailed task reference
- **[TROUBLESHOOTING.md](TROUBLESHOOTING.md)** - Common issues
- **[INSTALLATION.md](INSTALLATION.md)** - Installation guide
- **[MIGRATION_FROM_ANT.md](.gradle-docs/MIGRATION_FROM_ANT.md)** - Migration notes
- **[CONVERSION_SUMMARY.md](CONVERSION_SUMMARY.md)** - Conversion details

## 🚀 Quick Start

```powershell
# List all available tasks
gradle tasks

# Show build information
gradle info

# Initialize and setup
gradle initDirs
gradle loadLibs

# Verify environment
gradle verify

# Build the project
gradle build

# Create release
gradle release
```

## 📖 Key Features

✅ **Pure Gradle** - No Ant dependencies  
✅ **Fast Builds** - Build cache + incremental compilation  
✅ **Modern Features** - Configuration cache, parallel execution  
✅ **Well Documented** - Comprehensive documentation in `.gradle-docs/`  
✅ **Easy to Use** - Simple, intuitive commands  

## 🔍 Common Commands

| Command | Description |
|---------|-------------|
| `gradle tasks` | List all available tasks |
| `gradle info` | Show build configuration |
| `gradle verify` | Verify build environment |
| `gradle build` | Build the project |
| `gradle clean` | Clean build artifacts |
| `gradle release` | Create release package |

## 📂 Project Structure

```
dev/
├── build.gradle              # Pure Gradle build script
├── settings.gradle           # Project settings
├── gradle.properties         # Build configuration
├── .gradle-docs/             # Complete documentation
│   ├── INDEX.md             # Documentation index
│   ├── README.md            # Overview
│   ├── USAGE.md             # Usage guide
│   ├── TASKS.md             # Task reference
│   └── TROUBLESHOOTING.md   # Troubleshooting
├── gradle/                   # Gradle wrapper
├── bin/                      # Build output
├── tools/                    # Development tools
└── phpdev/                   # PHP development files
```

## ⚙️ Requirements

- **Gradle:** 8.0+ (recommended 9.2.0)
- **Java:** 11+ (tested with 23.0.2)
- **OS:** Windows, Linux, macOS

## 🆘 Getting Help

1. **Read the docs:** Start with [.gradle-docs/INDEX.md](INDEX.md)
2. **Run help commands:**
   ```powershell
   gradle tasks
   gradle info
   gradle help --task <taskname>
   ```
3. **Check troubleshooting:** See [.gradle-docs/TROUBLESHOOTING.md](TROUBLESHOOTING.md)

## 🔄 What Changed from Hybrid Build

This build has been converted from a hybrid Ant/Gradle build to pure Gradle:

- ❌ **Removed:** All Ant dependencies, imports, and build files
- ❌ **Deleted:** All `.xml` and `.properties` Ant build files
- ✅ **Added:** Native Gradle implementations for all tasks
- ✅ **Improved:** Performance, maintainability, and documentation
- ✅ **Maintained:** Same functionality and outputs

For details, see [.gradle-docs/CONVERSION_SUMMARY.md](CONVERSION_SUMMARY.md)

## 📝 Build Status

**Build System:** Pure Gradle ✅  
**Version:** 1.0.0  
**Status:** Production Ready  
**Documentation:** Complete  

---

**Get started:** `gradle tasks` or read [.gradle-docs/README.md](README.md)
