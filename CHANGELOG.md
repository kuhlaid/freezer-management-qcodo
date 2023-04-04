# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [v1.0.1] - future todo items

- [ ] document about the sample selection for pulling samples and Auto-select one sample option 
- [ ] add a form to add/edit sample container types
- [ ] modify the `src/examples/E03Box.php` script so it dynamically reads the specs for a box that is expecting specific barcode encoding for easier inclusion of additional boxes with special barcode encoding, or none at all


## [v1.0.0] - 2023.04.04

- [x] preparing the code for first release
- [x] creating a codegen directory outside of the main src directory so we do not pollute (or overwrite) our source if we regenerate code from the database
- [x] changing study/projects to be easily editable by admin user without needing to regenerate code; replace all instances of `StudyType::$NameArray` and `StudyType::ToString`
