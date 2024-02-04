#!/usr/bin/perl

my $sudoCount = '/var/log/auth.log';


open my $log_file, '<', $sudoCount or die "Error: Cannot open $sudoCount - $!";
    
my $count = 0;
    
while ($line = <$log_file>) {
	if ($line =~ /pam_unix\(sudo:session\): session opened/) {
		$count++;
	}
}
    
close $log_file;
print $count;




