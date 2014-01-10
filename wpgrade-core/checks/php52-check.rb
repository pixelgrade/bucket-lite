path = ARGV[0]

puts
puts " PHP 5.2 syntax check"
puts " --------------------"

def scan(path)
    errors = 0
    Dir.glob(path+'/*') do |file|
        next if file == '.' or file == '..'
        if File.directory? file
            errors += scan(file)
        else # not directory
            if file =~ /.*\.php$/
                msg = `php52 -l #{file}`
                if msg =~ /^No syntax errors.*/
                    puts "    valid #{file}"
                else # invalid
                    puts "  invalid #{file}"
                    puts msg.strip
                    puts
                    errors += 1
                end
            end
        end
    end#glob
    return errors
end

exit scan(path)
