################
# Postgres connection

#postgres client:
PGSQL	= psql

#postgres DB generator:
CREATEDB= createdb

#postgres User generator:
CREATEUSER= createuser

# you may add parameters for the connection process:
# -h hostname
#	supply a host to connect to
# -p portnumber
#	supply a (non-default) port
# you need DB-Admin privileges to execute this script:
# -U username
#	connect as a different user
# -W 
#	prompt for a password when connecting
PGOPT	=


#################
# Database Parameters

#User to be used when working with the DB:
#Rationale: it is safer to work with a user which is only used by
#CALM, since a breakage of CALM would then only affect the security
#of CALM itself. The other way round, a breakage of any other DB-User
#would not affect CALM.
DBUSER	= calm

#Database to create/use:
DBNAME	= calmdb

#options for creating the user
# -d User is allowed to create DB's
# -D User is not allowed to create DB's
# -a User is allowed to create users
# -A User is not allowed to create users
# -P prompt for a password for this user
DBPASSWD= -D -A -P


##############################################
## END OF USER CONFIG

all: initdb

initdb: _initdb.sql
	$(CREATEUSER) $(PGOPT) $(DBPASSWD) $(DBUSER)
	$(CREATEDB) $(PGOPT) $(DBNAME)
	$(PGSQL) $(PGOPT) -f $< $(DBNAME)


_initdb.sql: initdb.sql
	sed 's/@USER@/$(DBUSER)/' <$< >$@
