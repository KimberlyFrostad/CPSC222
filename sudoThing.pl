#!/usr/bin/perl

my $sudoCount = "/var/log/auth.log";

if (-e $sudoCount) {
    open my $log_file, '<', $sudoCount or die "Error: Cannot open $sudoCount - $!";
    
    my $count = 0;
    
    while (my $line = <$log_file>) {
        if ($line =~ "sudo:session") {
            $count++;
        }
    }
    
    close $log_file;
    
    $count = $count / 2;
    print $count;
} else {
    die "Error: $sudoCount not found";
}

