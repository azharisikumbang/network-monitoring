<?php

namespace App\Actions;

use App\Http\Requests\StoreNodeRequest;
use App\Models\Node;
use App\Models\Site;

final class CreateNewNodeAction
{
    public function executeFromRequest(StoreNodeRequest $request)
    {
        return Node::create($this->cleanDirtyValues($request));
    }

    private function cleanDirtyValues(StoreNodeRequest $request)
    {
        $validated = $request->validated();
        $site = Site::find($validated['site_id']);

        if (null === $validated['name'])
            $validated['name'] = $this->createDeviceName($site, $validated['type']);

        if (null === $validated['config_snmp_port'])
            $validated['config_snmp_port'] = Node::DEFAULT_SNMP_PORT;

        if (null === $validated['config_ssh_port'])
            $validated['config_ssh_port'] = Node::DEFAULT_SNMP_PORT;

        return $validated;
    }

    private function createDeviceName(Site $site, string $type): string
    {
        $devices = $site->nodes()->where('type', $type)->getResults();

        if ($devices->isEmpty())
            return $this->parseName($site->name, $type);

        $highest = 0;
        foreach ($devices as $device)
        {
            $temp = $this->getNumberFromName($device->name);
            if ($temp > $highest)
                $highest = $temp;
        }

        return $this->parseName($site->name, $type, $highest);
    }

    private function parseName(string $siteName, string $deviceType, int $number = 1): string
    {
        return sprintf("%s-%s-%d", $siteName, $deviceType, $number);
    }

    private function getNumberFromName(string $name): int
    {
        $divide = explode("-", $name);
        $found = count($divide);

        if ($found < 1)
            return 0;

        return (int) $divide[$found - 1];
    }
}