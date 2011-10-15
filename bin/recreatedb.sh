#!/bin/bash
echo "Recreate Tables"

if [[ "$1" == "dev" ]]
then
	echo "Use Constraints"
	cat schema/uninstall_constraints.sql |  mysql --host localhost --user raidgnome -praidgnome --database raidgnome_$1
fi

cat schema/uninstall_tables.sql |  mysql --host localhost --user raidgnome -praidgnome --database raidgnome_$1
cat schema/install_tables.sql |  mysql --host localhost --user raidgnome -praidgnome --database raidgnome_$1

if [[ "$1" == "dev" ]]
then
	cat schema/install_constraints.sql |  mysql --host localhost --user raidgnome -praidgnome --database raidgnome_$1
fi
