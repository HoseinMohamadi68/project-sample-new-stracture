<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterGuildAssociationFeeTrait
{
    /**
     * Filter by GuildAssociationFee.
     *
     * @param integer $guildAssociationFee GuildAssociationFee percentage.
     *
     * @return Builder
     */
    protected function guildAssociationFee(int $guildAssociationFee): Builder
    {
        return $this->builder->whereGuildAssociationFeeIs($guildAssociationFee);
    }

    /**
     * Filter by GuildAssociationFee.
     *
     * @param integer $guildAssociationFee GuildAssociationFee percentage.
     *
     * @return Builder
     */
    protected function guildAssociationFeeGreaterThan(int $guildAssociationFee): Builder
    {
        return $this->builder->whereGuildAssociationFeeGreaterThan($guildAssociationFee);
    }

    /**
     * Filter by GuildAssociationFee.
     *
     * @param integer $guildAssociationFee GuildAssociationFee percentage.
     *
     * @return Builder
     */
    protected function guildAssociationFeeLessThan(int $guildAssociationFee): Builder
    {
        return $this->builder->whereGuildAssociationFeeLessThan($guildAssociationFee);
    }
}
