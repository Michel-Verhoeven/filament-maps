<?php

namespace Webbingbrasil\FilamentMaps\Actions;

use Filament\Actions\Concerns\CanBeDisabled;
use Filament\Actions\Concerns\CanBeOutlined;
use Filament\Actions\Concerns\CanOpenUrl;
use Filament\Actions\Concerns\CanDispatchEvent;
use Filament\Actions\Concerns\CanSubmitForm;
use Filament\Actions\Concerns\HasKeyBindings;
use Filament\Support\Concerns\HasTooltip;
use Filament\Actions\Concerns\InteractsWithRecord;
use Closure;
use Filament\Actions\Action as BaseAction;
use Filament\Actions\Concerns;
use Illuminate\Support\Str;

class Action extends BaseAction
{
    use CanBeDisabled;
    use CanBeOutlined;
    use CanOpenUrl;
    use CanDispatchEvent;
    use CanSubmitForm;
    use HasKeyBindings;
    use HasTooltip;
    use InteractsWithRecord;

    protected string $position = 'topleft';

    protected string $view = 'filament-maps::button-action';

    protected function resolveDefaultClosureDependencyForEvaluationByName(string $parameterName): array
    {
        return match ($parameterName) {
            'record' => [$this->getRecord()],
            default => parent::resolveDefaultClosureDependencyForEvaluationByName($parameterName),
        };
    }

    public function position(string $position): static
    {
        $this->position = $position;

        return $this;
    }

    public function getPosition(): string
    {
        return $this->position;
    }

    public function getMapActionId(): string
    {
        return Str::afterLast($this->getLivewire()->getName(), '.') . '.' . $this->getName();
    }

    /**
     * @deprecated Use alpineClickHandler
     */
    public function callback(string | Closure | null $callback): static
    {
        return $this->alpineClickHandler($callback);
    }
}
