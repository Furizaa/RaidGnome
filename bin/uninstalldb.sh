#!/bin/sh
cat schema/uninstall_tables.sql |  mysql --host localhost --user raidgnome -praidgnome --database raidgnome_dev

