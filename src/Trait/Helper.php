<?php

namespace Joy2362\CrudSkeleton\Trait;

Trait Helper
{
    /**
     * Return the stub file path
     * @return string
     *
     */
    public function getStubPath()
    {
        return  __DIR__ .'/stubs/CrudClass.stub';
    }

    /**
     * Return the stub file path
     * @return string
     *
     */
    public function getProviderStubPath()
    {
        return  __DIR__ .'/stubs/ServiceProvider.stub';
    }

    /**
     * Build the directory for the class if necessary.
     *
     * @param string $path
     * @return string
     */
    protected function makeDirectory($path)
    {
        if (! $this->files->isDirectory($path)) {
            $this->files->makeDirectory($path, 0777, true, true);
        }

        return $path;
    }

    /**
     * Get the full path of generate class
     *
     * @return string
     */
    public function getSourceFileForClassPath()
    {
        return base_path('app\\Crud') .'\\' .$this->getSingularClassName($this->argument('name')) . 'Operation.php';
    }

    /**
     * Get the full path of generate class
     *
     * @return string
     */
    public function getSourceFileForProviderPath()
    {
        return base_path('app\\Providers') .'\\' .$this->getSingularClassName($this->argument('name')) . 'ServiceProvider.php';
    }

    public function getSingularClassName($name){
        return ucfirst($name);
    }

    /**
     * Replace the stub variables(key) with the desire value
     *
     * @param $stub
     * @param array $stubVariables
     * @return bool|mixed|string
     */
    public function getStubContents($stub , $stubVariables = [])
    {
        $contents = file_get_contents($stub);

        foreach ($stubVariables as $search => $replace)
        {
            $contents = str_replace('$'.$search.'$' , $replace, $contents);
        }

        return $contents;
    }


    /**
     * Get the stub path and the stub variables
     *
     * @return bool|mixed|string
     *
     */
    public function getSourceFile()
    {
        return $this->getStubContents($this->getStubPath(), $this->getStubVariables());
    }

    /**
     * Get the stub path and the stub variables
     *
     * @return bool|mixed|string
     *
     */
    public function getProviderSourceFile()
    {
        return $this->getStubContents($this->getProviderStubPath(), $this->getStubVariables());
    }

    /**
     **
     * Map the stub variables present in stub to its value
     *
     * @return array
     *
     */
    public function getStubVariables()
    {
        return [
            'NAMESPACE' => 'App\\Crud',
            'PROVIDER'=> 'App\\Providers',
            'NAME' => $this->argument('name'),
            'CLASS_NAME' => $this->getSingularClassName($this->argument('name')),
            'CONTROLLER' =>  $this->getSingularClassName($this->argument('name'))."Controller",
        ];
    }
}
