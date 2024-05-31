import * as graphql from "@nestjs/graphql";
import { CommandResolverBase } from "./base/command.resolver.base";
import { Command } from "./base/Command";
import { CommandService } from "./command.service";

@graphql.Resolver(() => Command)
export class CommandResolver extends CommandResolverBase {
  constructor(protected readonly service: CommandService) {
    super(service);
  }
}
