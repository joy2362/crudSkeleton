<?php
namespace Joy2362\CrudSkeleton\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Joy2362\CrudSkeleton\Trait\Helper;

class CreateCrudOperation extends Command
{
    use Helper;
    /**
     * Filesystem instance
     * @var Filesystem
     */
    protected Filesystem $files;

    protected $hidden = true;

    protected $signature = 'make:crud {name}';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    protected $description = 'implement crud operation based on module name';

    public function handle()
    {
        $class = $this->getSourceFileForClassPath();

        $provider = $this->getSourceFileForProviderPath();

        $this->makeDirectory(dirname($class));
        $this->makeDirectory(dirname($provider));

        $contents = $this->getSourceFile();
        $providerContents = $this->getProviderSourceFile();

        if (!$this->files->exists($class)) {
            $this->files->put($class, $contents);
            $this->info("Crud successfully created ");
        } else {
            $this->info("Crud : {$class} already exits");
        }

        if (!$this->files->exists($provider)){
            $this->files->put($provider, $providerContents);
            $this->info("Provider successfully created ");
        }else{
            $this->info("Provider : {$provider} already exits");
        }

        return 0;
    }
}