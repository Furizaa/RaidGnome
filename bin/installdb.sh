#!/bin/sh
cat schema/install_tables.sql |  mysql --host localhost --user raidgnome -praidgnome --database raidgnome_dev
